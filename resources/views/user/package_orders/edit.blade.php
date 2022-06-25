<h2 class="font-medium text-gray-500">@lang('msg.cancel_order')</h2>
<div class="mt-5">
    {!! Form::open(['route' => ['packageOrders.update', $packageOrder->id], 'method' => 'patch', 'id' => 'order-form']) !!}
    <div class="mt-5">
        <label class="text-gray-700 dark:text-gray-200" for="comment">@lang('models/packageOrders.fields.user_notes')</label>
        <textarea value="{{ old('user_notes') }}" name="user_notes"
            class="{{ $errors->has('user_notes') ? 'border-red-500' : '' }} block w-full h-20 px-4 py-2 text-gray-700 bg-white border rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40"></textarea>
        @error('user_notes')
            <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="flex items-end justify-end space-x-3 mt-5">
      <button
            class="px-8 py-2 bg-indigo-600 text-white text-xl font-bold  font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">
            @lang('crud.submit')
        </button>
      <button class="px-4 py-2 text-sm text-white bg-gray-600 toggle-view">@lang('crud.back')</button>
    </div>
    {{ Form::close() }}
</div>
