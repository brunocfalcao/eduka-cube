import { Carousel } from 'flowbite';

const items = [
    {
        position: 0,
        el: document.getElementById('testimonial-item-1')
    },
    {
        position: 1,
        el: document.getElementById('testimonial-item-2')
    },
    {
        position: 2,
        el: document.getElementById('testimonial-item-3')
    },
    {
        position: 3,
        el: document.getElementById('testimonial-item-4')
    },
];

const options = {
    defaultPosition: 0,
    interval: 3000,

    indicators: {
        activeClasses: 'border-transparent',
        inactiveClasses: 'border-transparent',
        items: [
            {
                position: 0,
                el: document.getElementById('testimonial-indicator-1')
            },
            {
                position: 1,
                el: document.getElementById('testimonial-indicator-2')
            },
            {
                position: 2,
                el: document.getElementById('testimonial-indicator-3')
            },
            {
                position: 3,
                el: document.getElementById('testimonial-indicator-4')
            },
        ]
    },

    // callback functions
    onNext: (carousel) => {
        console.log('onNext()');
        console.log(carousel);
    },
    onPrev: (carousel) => {
        console.log('onPrev()');
        console.log(carousel);
    },
    onChange: (carousel) => {
        console.log('onChange()');
        console.log(carousel);
    }
};

const testimonialsCarousel = new Carousel(items, options);

let slide1 = document.getElementById('testimonial-indicator-1');
let slide2 = document.getElementById('testimonial-indicator-2');
let slide3 = document.getElementById('testimonial-indicator-3');
let slide4 = document.getElementById('testimonial-indicator-4');

let indicators = [slide1, slide2, slide3, slide4];

slide1.addEventListener('click', () => {
    removeSelected();
    slide1.classList.add('selected');
});

slide2.addEventListener('click', () => {
    removeSelected();
    slide2.classList.add('selected');
});

slide3.addEventListener('click', () => {
    removeSelected();
    slide3.classList.add('selected');
});

slide4.addEventListener('click', () => {
    removeSelected();
    slide4.classList.add('selected');
});

function removeSelected() {
    slide1.classList.remove('selected');
    slide2.classList.remove('selected');
    slide3.classList.remove('selected');
    slide4.classList.remove('selected');
}
