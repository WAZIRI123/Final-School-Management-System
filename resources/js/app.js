import './bootstrap';
import * as Turbo from '@hotwired/turbo';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse'
Alpine.plugin(collapse)
window.Alpine = Alpine;

Alpine.start();
Turbo.start();