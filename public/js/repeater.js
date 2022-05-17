jQuery.fn.extend({
    createRepeater: function (options = {}) {
        var hasOption = function (optionKey) {
            return options.hasOwnProperty(optionKey);
        };

        var option = function (optionKey) {
            return options[optionKey];
        };

        var generateId = function (string) {
            return string
                .replace(/\[/g, '_')
                .replace(/\]/g, '')
                .toLowerCase();
        };

        var addItem = function (items, key, value = {}) {
            var itemContent = items;
            var group = itemContent.data("group");
            var item = itemContent;
            var input = item.find('input,select,textarea');

            input.each(function (index, el) {
                var attrName = $(el).data('name');
                var skipName = $(el).data('skip-name');
                var gid = generateId($(el).attr('name'));
                if (skipName == 'on') {
                    if (attrName != undefined) {
                        $(el).attr("name", attrName);
                    } else {
                        $(el).attr("name", group + "[" + key + "]");
                    }
                } else {
                    $(el).attr("name", group + "[" + key + "]" + "[" + attrName + "]");
                }

                if (value.hasOwnProperty($(el).attr('name'))) {
                    if($(el).is('select')) { 
                        $(el).find('option').removeAttr('selected');
                        $(el).find('option[value=' + value[$(el).attr('name')] + ']').attr('selected', 'selected');
                    } else {
                        $(el).attr('value', value[$(el).attr('name')]);
                    }
                } else {
                    $(el).attr('value', null);
                }

                $(el).attr('id', gid);
                $(el).parent().find('label').attr('for', generateId($(el).attr('name')));
            })

            var itemClone = items;

            /* Handling remove btn */
            var removeButton = itemClone.find('.remove-btn');

            if (key == 0 && disable) {
                removeButton.attr('disabled', true);
            } else {
                removeButton.attr('disabled', false);
            }

            removeButton.attr('onclick', '$(this).parents(\'.items\').remove()');

            var newItem = $("<div class='items'>" + itemClone.html() + "<div/>");
            newItem.attr('data-index', key)

            newItem.appendTo(repeater);

            $(newItem).find('.select2').select2();
        };

        /* find elements */
        var repeater = this;
        var items = repeater.find(".items");
        var key = 0;
        var addButton = repeater.find('.repeater-add-btn');
        var disable = hasOption('disableFirstItemRemoveButton') && option('disableFirstItemRemoveButton') == true;

        items.each(function (index, item) {
            items.remove();
            if (hasOption('values') && option('values').length > 0) {
                option('values').forEach(value => {
                    addItem($(item), key, value);
                    key++;
                });
                
            } else if (hasOption('showFirstItemToDefault') && option('showFirstItemToDefault') == true) {
                addItem($(item), key);
                key++;
            } else {
                if (items.length > 1) {
                    addItem($(item), key);
                    key++;
                }
            }
        });

        /* handle click and add items */
        addButton.on("click", function () {
            addItem($(items[0]), key);
            key++;
        });
    }
});
