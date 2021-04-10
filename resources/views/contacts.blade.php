@extends('layout')

@section('content')
    <h2 class="main-text-color text-center">Ways to Contact Us</h2>
    <div class="contacts-container flex relative">
        <div class="contacts-wrapper">
            <h2 class="text-center alt-text-color">Get in touch with us</h2>
            <div class="mb-20 flex flex-col centering">
                <div class="contacts-label">Our Office:</div>
                <div class="main-text-color contacts-info">
                    <span class="p-5">
                        <i class="fas fa-compass"></i>
                        Somestreet 147av. Kaunas, Lithuania
                    </span>
                </div>
            </div>
            <div class="mb-20 flex flex-col centering">
                <div class="contacts-label">Call us:</div>
                <div class="contacts-info">
                    <a href="tel:+6494461709">
                        <i class="fas fa-phone-square-alt"></i>
                        +6494461709
                    </a>
                </div>
            </div>
            <div class="flex flex-col centering">
                <div class="contacts-label">Email us:</div>
                <div class="contacts-info">
                    <a href="mailto:info@campings.com">
                        <i class="fas fa-envelope-square"></i> 
                        info@campings.com
                    </a>
                </div>
            </div>
        </div>
        <div class="contacts-form-wrapper flex flex-col centering">
            <h2 class="alt-text-color">Write us a message</h2>
            <contactsform-component></contactsform-component>
        </div>
    </div>
@endsection