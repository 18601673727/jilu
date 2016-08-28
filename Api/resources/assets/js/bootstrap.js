import jquery from 'jquery';
window.$ = window.jQuery = jquery;

import * as moment from 'moment';
import 'moment-duration-format';
import 'moment/locale/zh-cn';
window.moment = moment;

import 'jquery.rateit';

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
