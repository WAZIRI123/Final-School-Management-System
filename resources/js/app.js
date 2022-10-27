import './bootstrap';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import * as Turbo from '@hotwired/turbo';
Alpine.plugin(collapse)
window.Alpine = Alpine;
Turbo.start();
Alpine.start();