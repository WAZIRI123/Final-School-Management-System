import './bootstrap';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import * as Turbo from '@hotwired/turbo';
Alpine.plugin(collapse)
window.Alpine = Alpine;
document.addEventListener("livewire:load", function(event) {
    Turbo.start();

});

Alpine.start();