import React from 'react';

export default function AppBarLogo() {

    return (
        <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26" width="26" height="26">
            <title>generic logo</title>
            <defs>
                <image  width="26" height="26" id="img1" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaAQMAAACThN6NAAAAAXNSR0IB2cksfwAAAANQTFRF////p8QbyAAAAA5JREFUeJxjZAACxoEkAAddABs0vUMgAAAAAElFTkSuQmCC"/>
                <image  width="49" height="49" id="img2" href="data:image/png;base64,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"/>
            </defs>
            <style>
            </style>
            <use id="Background" href="#img1" x="0" y="0"/>
            <use id="Layer 1" href="#img2" x="-12" y="-6"/>
        </svg>
    );
}
