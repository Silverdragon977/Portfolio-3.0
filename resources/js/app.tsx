// console.log('React loaded successfully');
import './bootstrap';
import Alpine from 'alpinejs';
import * as bootstrap from 'bootstrap'

window.Alpine = Alpine;
Alpine.start()


import React from 'react';
import ReactDOM from 'react-dom/client';

// function Test() {
//     return (
//         <div>
//             <h1>React Test</h1>
//         </div>
//     );
// }

// const reactRoot = document.getElementById('react-root');
// if (reactRoot) {
//     ReactDOM.createRoot(reactRoot).render(
//         <React.StrictMode>
//             <Test />
//         </React.StrictMode>
//     );
// }

import ClickerHero from './games/ClickerHero/ClickerHero';
const clickerHeroRoot = document.getElementById('clicker-hero-root');
// console.log('Clicker Hero root element:', clickerHeroRoot);
if (clickerHeroRoot) {
    // const root = ReactDOM.createRoot(clickerHeroRoot);
    ReactDOM.createRoot(clickerHeroRoot).render
    (
        <React.StrictMode>
            <ClickerHero />
        </React.StrictMode>
    );
}
