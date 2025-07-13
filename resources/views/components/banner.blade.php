<!-- Example of parent view -->
<x-banner :title="$title" :message="$message" />

<!-- resources\views\your-view.blade.php -->

@php
    $title = 'Welcome to Savings Sacco';
    $message = 'Your message here';
@endphp

<x-banner :title="$title" :message="$message" />
