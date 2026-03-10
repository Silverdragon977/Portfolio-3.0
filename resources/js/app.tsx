import './bootstrap';

console.log('JS running successfully');

import Alpine from 'alpinejs';
import 'bootstrap/dist/js/bootstrap.bundle';

declare global {
    interface Window {
        Alpine: typeof Alpine;
    }
}

import React from 'react';
import ReactDOM from 'react-dom/client';

import ClickerHero from './games/ClickerHero/ClickerHero';

window.Alpine = Alpine;
Alpine.start();

console.log('Alpine and Bootstrap init successfully');

// const clickerHeroRoot = document.getElementById('clicker-hero-root');
// console.log('Clicker Hero root element:', clickerHeroRoot);
// if (clickerHeroRoot) {
//     const root = ReactDOM.createRoot(clickerHeroRoot);
//     root.render(
//         <React.StrictMode>
//             <ClickerHero />
//         </React.StrictMode>
//     );
// }
