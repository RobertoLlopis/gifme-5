
require('./bootstrap');
require('alpinejs');

import { $ } from './utils.js';
import { handleHomeSubmit } from './listeners';

$('.home').addEventListener('submit', handleHomeSubmit);



