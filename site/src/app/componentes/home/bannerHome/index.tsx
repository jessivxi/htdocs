'use client'

import React, { useEffect } from 'react'
import useEmblaCarousel from 'embla-carousel-react'
import './style.css'


export function BannerHome() {
    const [emblaRef, emblaApi] = useEmblaCarousel({
        loop: true

    });

    useEffect(() => {
        if (emblaApi) {
            console.log(emblaApi.slideNodes()); // Access API
        }
    }, [emblaApi]);

    const slides = [
        'https:placehold.co/1920x1080.png?text=Slide+1',
        'https://placehold.co/1920x1080.png?text=Slide+2',
        'https://placehold.co/1920x1080.png?text=Slide+3',
        'https://placehold.co/1920x1080.png?text=Slide+4',
        'https://placehold.co/1920x1080.png?text=Slide+5',
    ];

    return (
        <section>
            <div className="embla" ref={emblaRef}>
                <div className="embla__container">
                    {slides.map((slide, index) => (
                        <div key={index} className="embla__slide">
                            <img
                                src={slide}
                                alt={`Slide ${index + 1}`}
                                width={1920}
                                height={1080}
                            />
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
}





































