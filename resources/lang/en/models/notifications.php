<?php

return array (
  'singular' => 'Notification',
  'plural' => 'Notifications',
  'fields' => [
    'id' => 'Id',
    'title' => 'Title',
    'text' => 'Text',
    'url' => 'Url',
    'icon' => 'Icon',
    'type' => 'Type',
    'to' => 'To',
    'admin_id' => 'Admin Id',
    'user_id' => 'User Id',
    'provider_id' => 'Provider Id',
    'read_at' => 'Read At',
    'status' => 'Status',
    'created_at' => 'Created At',
    'updated_at' => 'Updated At',
  ],
  'types' => [
    'primary' => 'Primary',
    'info' => 'Info',
    'success' => 'Success',
    'warning' => 'Warning',
    'danger' => 'Danger',
  ],
  'to' => [
    'admin' => 'Admin',
    'user' => 'User',
    'provider' => 'Provider',
    'all_admins' => 'All Admins',
    'all_users' => 'All Users',
    'all_providers' => 'All Providers',
  ],
  'unauthorized' => 'Sorry, you are not authorized to access this notification.',
  'read' => 'Read',
  'unread' => 'Unread',
  'general' => 'General'
);
