@extends('front.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('front/css/projects.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<style>
:root {
    --primary-color: #6366f1;
    --primary-light: #a5b4fc;
    --primary-dark: #4f46e5;
    --secondary-color: #8b5cf6;
    --accent-color: #7c3aed;
    --dark-color: #0f172a;
    --light-color: #f8fafc;
    --text-color: #e2e8f0;
    --text-light: #94a3b8;
    --gradient: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    --border-radius: 16px;
    --box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* General Styles */
html {
    font-size: 16px;
    scroll-behavior: smooth;
}

body {
    background-color: #0f172a;
    color: var(--text-color);
    font-family: 'Inter', sans-serif;
    line-height: 1.6;
}

/* Project Detail Section */
.project-detail-section {
    background: rgba(15, 23, 42, 0.8);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-radius: var(--border-radius);
    margin: 2rem auto;
    max-width: 95%;
    border: 1px solid rgba(255, 255, 255, 0.08);
    box-shadow: var(--box-shadow);
    position: relative;
    overflow: hidden;
    padding: 4rem 0;
}

.project-detail-section::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle at center, rgba(99, 102, 241, 0.1) 0%, transparent 70%);
    z-index: -1;
    animation: pulse 15s infinite alternate;
}

@keyframes pulse {
    0% {
        transform: translate(0, 0);
    }
    50% {
        transform: translate(10%, 10%);
    }
    100% {
        transform: translate(-10%, -10%);
    }
}

/* Back Button */
.back-btn {
    display: inline-flex;
    align-items: center;
    padding: 0.75rem 1.5rem;
    background: rgba(99, 102, 241, 0.2);
    color: var(--primary-light);
    border-radius: 50px;
    text-decoration: none;
    font-weight: 500;
    transition: var(--transition);
    margin-bottom: 2rem;
    border: 1px solid rgba(99, 102, 241, 0.3);
    backdrop-filter: blur(5px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.back-btn:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 10px 15px rgba(99, 102, 241, 0.3);
}

.back-btn i {
    transition: var(--transition);
}

.back-btn:hover i {
    transform: translateX(-3px);
}

/* Project Header */
.project-header {
    margin-bottom: 3rem;
    position: relative;
}

.project-title {
    font-size: 2.75rem;
    font-weight: 800;
    color: white;
    margin-bottom: 1rem;
    line-height: 1.2;
    background: linear-gradient(to right, white, var(--primary-light));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    position: relative;
    display: inline-block;
}

.project-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 60px;
    height: 4px;
    background: var(--gradient);
    border-radius: 2px;
}

.project-meta {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.project-category, .project-date {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 500;
    backdrop-filter: blur(5px);
    transition: var(--transition);
}

.project-category {
    background: rgba(99, 102, 241, 0.2);
    color: var(--primary-light);
    border: 1px solid rgba(99, 102, 241, 0.3);
}

.project-category:hover {
    background: var(--primary-color);
    color: white;
}

.project-date {
    background: rgba(148, 163, 184, 0.15);
    color: var(--text-light);
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.project-date:hover {
    background: rgba(148, 163, 184, 0.25);
}

/* Project Gallery */
.project-gallery-container {
    margin-bottom: 3rem;
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    transform: translateZ(0);
}

.project-swiper {
    width: 100%;
    height: 500px;
    border-radius: var(--border-radius);
}

.project-swiper .swiper-slide {
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(15, 23, 42, 0.7);
    position: relative;
}

.project-swiper .swiper-slide img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    padding: 2rem;
    background: transparent;
    transition: transform 0.5s ease;
}

.project-swiper .swiper-slide:hover img {
    transform: scale(1.03);
}

.project-swiper .swiper-button-next,
.project-swiper .swiper-button-prev {
    color: white;
    background: rgba(99, 102, 241, 0.7);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    transition: var(--transition);
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    opacity: 0.8;
}

.project-swiper .swiper-button-next:hover,
.project-swiper .swiper-button-prev:hover {
    background: var(--primary-color);
    opacity: 1;
    transform: scale(1.1);
}

.project-swiper .swiper-button-next::after,
.project-swiper .swiper-button-prev::after {
    font-size: 1.5rem;
    font-weight: bold;
}

.project-swiper .swiper-pagination-bullet {
    background: white;
    opacity: 0.6;
    width: 12px;
    height: 12px;
    transition: var(--transition);
}

.project-swiper .swiper-pagination-bullet-active {
    background: var(--primary-color);
    opacity: 1;
    transform: scale(1.2);
}

/* Project Content */
.project-content {
    margin-bottom: 3rem;
    position: relative;
}

.section-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    position: relative;
}

.section-title i {
    margin-right: 0.75rem;
    color: var(--primary-light);
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 50px;
    height: 3px;
    background: var(--gradient);
    border-radius: 3px;
}

.project-description {
    font-size: 1.1rem;
    line-height: 1.8;
    color: rgba(226, 232, 240, 0.9);
}

.project-description p {
    margin-bottom: 1.5rem;
    position: relative;
    padding-left: 1.5rem;
}

.project-description p::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0.75rem;
    width: 8px;
    height: 8px;
    background: var(--primary-color);
    border-radius: 50%;
}

/* Sidebar Styles */
.project-sidebar {
    position: sticky;
    top: 20px;
}

.sidebar-card {
    background: rgba(15, 23, 42, 0.6);
    border-radius: var(--border-radius);
    padding: 1.75rem;
    margin-bottom: 2rem;
    box-shadow: var(--box-shadow);
    transition: var(--transition);
    border: 1px solid rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(5px);
    overflow: hidden;
    position: relative;
}

.sidebar-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--gradient);
}

.sidebar-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    border-color: rgba(99, 102, 241, 0.3);
}

.sidebar-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: white;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
}

.sidebar-title i {
    margin-right: 0.75rem;
    color: var(--primary-light);
}

/* Technologies Tags */
.tech-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.tech-tag {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    background-color: rgba(99, 102, 241, 0.15);
    color: var(--primary-light);
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 500;
    border: 1px solid rgba(99, 102, 241, 0.3);
    transition: var(--transition);
}

.tech-tag:hover {
    background-color: var(--primary-color);
    color: white;
    transform: translateY(-2px);
}

/* Project Links - المحسن */
.project-links-grid {
    display: grid;
    gap: 1rem;
}

.project-link {
    display: flex;
    align-items: center;
    padding: 1rem;
    border-radius: 12px;
    text-decoration: none;
    transition: var(--transition);
    background-color: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.08);
    position: relative;
    overflow: hidden;
}

.project-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    transition: 0.6s;
}

.project-link:hover::before {
    left: 100%;
}

.link-icon {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    transition: var(--transition);
    flex-shrink: 0;
}

.link-content {
    flex-grow: 1;
}

.link-title {
    display: block;
    font-weight: 600;
    color: white;
    margin-bottom: 0.25rem;
}

.link-subtitle {
    display: block;
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.7);
}

.link-arrow {
    opacity: 0;
    transform: translateX(-10px);
    transition: var(--transition);
    color: rgba(255, 255, 255, 0.7);
}

.project-link:hover .link-arrow {
    opacity: 1;
    transform: translateX(0);
}

/* أنماط خاصة بكل نوع من الروابط */
.github-link {
    border-left: 4px solid #6e5494;
}

.github-link .link-icon {
    background: rgba(110, 84, 148, 0.2);
    color: #6e5494;
}

.github-link:hover {
    background: rgba(110, 84, 148, 0.15);
    border-color: rgba(110, 84, 148, 0.3);
}

.demo-link {
    border-left: 4px solid #6366f1;
}

.demo-link .link-icon {
    background: rgba(99, 102, 241, 0.2);
    color: #6366f1;
}

.demo-link:hover {
    background: rgba(99, 102, 241, 0.15);
    border-color: rgba(99, 102, 241, 0.3);
}

.playstore-link {
    border-left: 4px solid #28a745;
}

.playstore-link .link-icon {
    background: rgba(40, 167, 69, 0.2);
    color: #28a745;
}

.playstore-link:hover {
    background: rgba(40, 167, 69, 0.15);
    border-color: rgba(40, 167, 69, 0.3);
}

/* Project Info List */
.project-info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.project-info-list li {
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    display: flex;
    align-items: center;
    transition: var(--transition);
}

.project-info-list li:hover {
    color: white;
}

.project-info-list li:last-child {
    border-bottom: none;
}

.project-info-list i {
    margin-right: 1rem;
    color: var(--primary-light);
    width: 24px;
    text-align: center;
    font-size: 1.1rem;
}

.project-info-list strong {
    font-weight: 600;
    margin-right: 0.5rem;
}

/* Related Projects Section */
.related-projects {
    background: rgba(15, 23, 42, 0.8);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-radius: var(--border-radius);
    margin: 2rem auto;
    max-width: 95%;
    border: 1px solid rgba(255, 255, 255, 0.08);
    box-shadow: var(--box-shadow);
    position: relative;
    overflow: hidden;
    padding: 4rem 0;
}

.related-projects::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at 80% 20%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
    z-index: -1;
}

.section-header {
    margin-bottom: 3rem;
    text-align: center;
    position: relative;
}

.section-header .section-title {
    font-size: 2.25rem;
    font-weight: 800;
    color: white;
    margin-bottom: 1rem;
    background: linear-gradient(to right, white, var(--primary-light));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    display: inline-block;
}

.section-header .section-subtitle {
    color: var(--text-light);
    font-size: 1.1rem;
    max-width: 600px;
    margin: 0 auto;
}

.related-projects-slider {
    padding: 1rem;
    position: relative;
}

.project-card {
    background: rgba(30, 41, 59, 0.6);
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--box-shadow);
    transition: var(--transition);
    height: 100%;
    display: flex;
    flex-direction: column;
    border: 1px solid rgba(255, 255, 255, 0.08);
    position: relative;
}

.project-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    border-color: rgba(99, 102, 241, 0.3);
}

.project-card-image {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.project-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.project-card:hover .project-card-image img {
    transform: scale(1.1);
}

.project-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to top, rgba(79, 70, 229, 0.9) 0%, transparent 100%);
    display: flex;
    align-items: flex-end;
    justify-content: flex-start;
    opacity: 0;
    transition: var(--transition);
    padding: 1.5rem;
}

.project-card:hover .project-overlay {
    opacity: 1;
}

.btn-view {
    background: white;
    color: var(--primary-dark);
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-weight: 600;
    transition: var(--transition);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    display: inline-flex;
    align-items: center;
}

.btn-view:hover {
    background: var(--dark-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
}

.btn-view i {
    margin-right: 0.5rem;
}

.project-card-body {
    padding: 1.75rem;
    flex-grow: 1;
}

.project-card-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: white;
    margin-bottom: 0.75rem;
    transition: var(--transition);
}

.project-card:hover .project-card-title {
    color: var(--primary-light);
}

.project-card-text {
    color: var(--text-light);
    margin-bottom: 1.5rem;
    font-size: 0.95rem;
}

.project-card-footer {
    margin-top: auto;
}

.project-card-footer .badge {
    background: rgba(99, 102, 241, 0.2);
    color: var(--primary-light);
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-weight: 500;
    border: 1px solid rgba(99, 102, 241, 0.3);
    transition: var(--transition);
}

.project-card:hover .project-card-footer .badge {
    background: var(--primary-color);
    color: white;
}

/* Swiper Navigation for Related Projects */
.related-projects-slider .swiper-button-next,
.related-projects-slider .swiper-button-prev {
    color: white;
    background: rgba(99, 102, 241, 0.7);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    transition: var(--transition);
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    opacity: 0.8;
}

.related-projects-slider .swiper-button-next:hover,
.related-projects-slider .swiper-button-prev:hover {
    background: var(--primary-color);
    opacity: 1;
    transform: scale(1.1);
}

.related-projects-slider .swiper-button-next::after,
.related-projects-slider .swiper-button-prev::after {
    font-size: 1.2rem;
    font-weight: bold;
}

.related-projects-slider .swiper-pagination-bullet {
    background: white;
    opacity: 0.6;
    width: 10px;
    height: 10px;
    transition: var(--transition);
}

.related-projects-slider .swiper-pagination-bullet-active {
    background: var(--primary-color);
    opacity: 1;
    transform: scale(1.2);
}

/* Floating Elements Animation */
.floating-element {
    position: absolute;
    border-radius: 50%;
    background: rgba(99, 102, 241, 0.1);
    backdrop-filter: blur(5px);
    animation: float 15s infinite ease-in-out;
    z-index: -1;
}

@keyframes float {
    0%, 100% {
        transform: translate(0, 0);
    }
    50% {
        transform: translate(10px, 10px);
    }
}

/* Responsive Styles */
@media (max-width: 1400px) {
    .container {
        max-width: 1140px;
    }
}

@media (max-width: 1200px) {
    .project-title {
        font-size: 2.5rem;
    }
    
    .project-swiper {
        height: 450px;
    }
    
    .related-projects-slider {
        padding: 0.5rem;
    }
}

@media (max-width: 992px) {
    html {
        font-size: 15px;
    }
    
    .project-title {
        font-size: 2.25rem;
    }
    
    .project-swiper {
        height: 400px;
    }
    
    .project-content {
        padding: 0;
    }
    
    .project-sidebar {
        margin-top: 3rem;
        position: static;
    }
    
    .related-projects-slider {
        padding: 0;
    }
    
    .section-header .section-title {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    .project-detail-section,
    .related-projects {
        border-radius: 0;
        margin: 0;
        max-width: 100%;
        padding: 3rem 0;
    }
    
    .project-title {
        font-size: 2rem;
    }
    
    .project-swiper {
        height: 350px;
    }
    
    .project-header {
        margin-bottom: 2rem;
    }
    
    .project-content, 
    .project-gallery-container {
        margin-bottom: 2rem;
    }
    
    .section-title {
        font-size: 1.5rem;
    }
    
    .project-swiper .swiper-button-next, 
    .project-swiper .swiper-button-prev {
        display: none;
    }
    
    .project-swiper .swiper-pagination {
        bottom: 10px;
    }
    
    .section-header .section-title {
        font-size: 1.75rem;
    }
}

@media (max-width: 576px) {
    html {
        font-size: 14px;
    }
    
    .project-title {
        font-size: 1.75rem;
    }
    
    .project-meta {
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .project-swiper {
        height: 300px;
    }
    
    .section-title {
        font-size: 1.4rem;
    }
    
    .project-description {
        font-size: 1rem;
        line-height: 1.7;
    }
    
    .sidebar-card {
        padding: 1.5rem;
    }
    
    .project-link {
        padding: 1.25rem 1rem;
    }
    
    .back-btn span {
        display: none;
    }
    
    .back-btn i {
        margin-right: 0;
    }
    
    .section-header .section-title {
        font-size: 1.5rem;
    }
    
    .project-card-title {
        font-size: 1.1rem;
    }
    
    .project-card-image {
        height: 180px;
    }
    
    .project-overlay {
        padding: 1rem;
    }
    
    .btn-view {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }
}

@media (max-width: 400px) {
    .project-title {
        font-size: 1.5rem;
    }
    
    .project-swiper {
        height: 250px;
    }
    
    .section-title {
        font-size: 1.3rem;
    }
    
    .sidebar-card {
        padding: 1.25rem;
    }
    
    .tech-tag {
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
    }
}

/* Touch Device Optimizations */
@media (hover: none) {
    .project-link, 
    .back-btn, 
    .btn-view,
    .tech-tag {
        min-height: 44px;
        min-width: 44px;
    }
    
    .project-swiper .swiper-button-next,
    .project-swiper .swiper-button-prev,
    .related-projects-slider .swiper-button-next,
    .related-projects-slider .swiper-button-prev {
        width: 44px;
        height: 44px;
    }
    
    .project-card:hover {
        transform: none;
        box-shadow: var(--box-shadow);
    }
    
    .project-overlay {
        opacity: 1;
        background: linear-gradient(to top, rgba(15, 23, 42, 0.9) 0%, transparent 100%);
    }
    
    .link-arrow {
        opacity: 1;
        transform: translateX(0);
    }
}
</style>
@endpush

@section('content')
<section class="project-detail-section py-6">
    <!-- Floating Background Elements -->
    <div class="floating-element" style="width: 100px; height: 100px; top: 10%; left: 5%; animation-delay: 0s;"></div>
    <div class="floating-element" style="width: 150px; height: 150px; bottom: 15%; right: 8%; animation-delay: 2s;"></div>
    <div class="floating-element" style="width: 80px; height: 80px; top: 30%; right: 10%; animation-delay: 4s;"></div>
    
    <div class="container">
        <!-- Back Button -->
        <div class="animate__animated animate__fadeInDown">
            <a href="{{ route('projects') }}" class="back-btn">
                <i class="fas fa-arrow-left me-2"></i> 
                <span class="d-none d-sm-inline">Back to projects</span>
            </a>
        </div>

        <!-- Project Header -->
        <div class="project-header animate__animated animate__fadeIn">
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <h1 class="project-title">{{ $project->title }}</h1>
                <div class="project-meta">
                    <span class="project-category">
                        @if($project->category == 'web')
                            <i class="fas fa-globe me-1"></i> Web Application
                        @elseif($project->category == 'mobile')
                            <i class="fas fa-mobile-alt me-1"></i> Mobile App
                        @else
                            <i class="fas fa-desktop me-1"></i> Desktop App
                        @endif
                    </span>
                    @if($project->completed_at)
                    <span class="project-date">
                        <i class="far fa-calendar-alt me-1"></i> 
                        {{ $project->completed_at->format('M Y') }}
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row g-5">
            <!-- Main Gallery -->
            <div class="col-lg-8">
                <div class="project-gallery-container animate__animated animate__fadeIn">
                    <!-- Swiper Slider -->
                    <div class="swiper-container project-swiper">
                        <div class="swiper-wrapper">
                            @foreach($project->images as $image)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/' . $image->image_path) }}" 
                                     alt="Project Image {{ $loop->iteration }}" 
                                     class="img-fluid rounded-3"
                                     loading="lazy">
                            </div>
                            @endforeach
                        </div>
                        <!-- Pagination -->
                        <div class="swiper-pagination"></div>
                        <!-- Navigation -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>

                <!-- Project Description -->
                <div class="project-content animate__animated animate__fadeInUp">
                    <h2 class="section-title">
                        <i class="fas fa-align-left me-2"></i> Project Overview
                    </h2>
                    <div class="project-description">
                        {!! nl2br(e($project->description)) !!}
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-lg-4">
                <div class="project-sidebar">
                    <!-- Technologies Used -->
                    <div class="sidebar-card animate__animated animate__fadeInRight">
                        <h3 class="sidebar-title">
                            <i class="fas fa-code me-2"></i> Technologies Stack
                        </h3>
                        <div class="tech-tags">
                            @foreach(explode(',', $project->technologies) as $tech)
                            <span class="tech-tag">{{ trim($tech) }}</span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Project Links - المحسن -->
                    <div class="sidebar-card animate__animated animate__fadeInRight">
                        <h3 class="sidebar-title">
                            <i class="fas fa-rocket me-2"></i> Project Links
                        </h3>
                        <div class="project-links-grid">
                            @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="project-link github-link">
                                <div class="link-icon">
                                    <i class="fab fa-github"></i>
                                </div>
                                <div class="link-content">
                                    <span class="link-title">GitHub Repository</span>
                                    <span class="link-subtitle">View source code</span>
                                </div>
                                <div class="link-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>
                            @endif
                            
                            @if($project->demo_url)
                            <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer" class="project-link demo-link">
                                <div class="link-icon">
                                    <i class="fas fa-external-link-alt"></i>
                                </div>
                                <div class="link-content">
                                    <span class="link-title">Live Demo</span>
                                    <span class="link-subtitle">Try it online</span>
                                </div>
                                <div class="link-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>
                            @endif
                            
                            @if($project->play_store_url)
                            <a href="{{ $project->play_store_url }}" target="_blank" rel="noopener noreferrer" class="project-link playstore-link">
                                <div class="link-icon">
                                    <i class="fab fa-google-play"></i>
                                </div>
                                <div class="link-content">
                                    <span class="link-title">Google Play</span>
                                    <span class="link-subtitle">Download app</span>
                                </div>
                                <div class="link-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>
                            @endif
                        </div>
                    </div>

                    <!-- Project Info -->
                    <div class="sidebar-card animate__animated animate__fadeInRight">
                        <h3 class="sidebar-title">
                            <i class="fas fa-info-circle me-2"></i> Project Details
                        </h3>
                        <ul class="project-info-list">
                            <li>
                                <i class="fas fa-layer-group me-2"></i>
                                <strong>Category:</strong> 
                                @if($project->category == 'web')
                                   Web Application
                                @elseif($project->category == 'mobile')
                                   Mobile Application
                                @else
                                   Desktop Application
                                @endif
                            </li>
                            @if($project->client)
                            <li>
                                <i class="fas fa-user-tie me-2"></i>
                                <strong>Client:</strong> {{ $project->client }}
                            </li>
                            @endif
                            @if($project->completed_at)
                            <li>
                                <i class="far fa-calendar-check me-2"></i>
                                <strong>Completed:</strong> {{ $project->completed_at->format('F Y') }}
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Projects -->
@if($relatedProjects->count() > 0)
<section class="related-projects py-5">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">You Might Also Like</h2>
            <p class="section-subtitle">Explore other projects that may interest you</p>
        </div>
        
        <div class="swiper-container related-projects-slider">
            <div class="swiper-wrapper">
                @foreach($relatedProjects as $related)
                <div class="swiper-slide">
                    <div class="project-card">
                        <div class="project-card-image">
                            @if($related->images->count() > 0)
                                <img src="{{ asset('storage/' . $related->images[0]->image_path) }}" 
                                     alt="{{ $related->title }}"
                                     class="img-fluid"
                                     loading="lazy">
                            @endif
                            <div class="project-overlay">
                                <a href="{{ route('project.detail', $related->id) }}" class="btn btn-view">
                                    <i class="fas fa-eye me-1"></i> View Project
                                </a>
                            </div>
                        </div>
                        <div class="project-card-body">
                            <h5 class="project-card-title">{{ $related->title }}</h5>
                            <p class="project-card-text">{{ Str::limit($related->description, 100) }}</p>
                            <div class="project-card-footer">
                                <span class="badge">
                                    @if($related->category == 'web')
                                        Web
                                    @elseif($related->category == 'mobile')
                                        Mobile
                                    @else
                                        Desktop
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>
@endif
@endsection

@push('scripts')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize main project swiper with enhanced settings
    const projectSwiper = new Swiper('.project-swiper', {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        effect: 'creative',
        creativeEffect: {
            prev: {
                shadow: true,
                translate: [0, 0, -400],
            },
            next: {
                translate: ['100%', 0, 0],
            },
        },
        keyboard: {
            enabled: true,
            onlyInViewport: true,
        },
        grabCursor: true,
        preloadImages: false,
        lazy: true,
    });

    // Initialize related projects swiper
    const relatedSwiper = new Swiper('.related-projects-slider', {
        slidesPerView: 1,
        spaceBetween: 20,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            576: {
                slidesPerView: 2,
                spaceBetween: 15,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            1200: {
                slidesPerView: 3,
                spaceBetween: 30,
            }
        }
    });

    // GSAP Animations
    gsap.from('.project-title', {
        duration: 1,
        y: 50,
        opacity: 0,
        ease: 'power3.out'
    });

    gsap.from('.project-meta span', {
        duration: 1,
        x: -20,
        opacity: 0,
        stagger: 0.2,
        delay: 0.3,
        ease: 'back.out'
    });

    gsap.from('.project-gallery-container', {
        duration: 1,
        y: 50,
        opacity: 0,
        delay: 0.5,
        ease: 'power3.out'
    });

    gsap.from('.sidebar-card', {
        duration: 0.8,
        x: 50,
        opacity: 0,
        stagger: 0.2,
        delay: 0.7,
        ease: 'back.out'
    });

    // Animation on scroll
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.animate__animated');
        
        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const screenPosition = window.innerHeight / 1.2;
            
            if(elementPosition < screenPosition) {
                const animationClass = Array.from(element.classList).find(cls => 
                    cls.startsWith('animate__') && cls !== 'animate__animated'
                );
                
                if(animationClass) {
                    element.classList.add(animationClass);
                }
            }
        });
    };

    // Run on load and on scroll
    animateOnScroll();
    window.addEventListener('scroll', animateOnScroll);

    // Floating elements animation
    const floatingElements = document.querySelectorAll('.floating-element');
    floatingElements.forEach((el, index) => {
        gsap.to(el, {
            y: 20,
            duration: 5 + index,
            repeat: -1,
            yoyo: true,
            ease: "sine.inOut"
        });
    });

    // Enhanced link click animation
    document.querySelectorAll('.project-link').forEach(link => {
        link.addEventListener('click', function(e) {
            if (!this.getAttribute('target') || this.getAttribute('target') === '_self') {
                e.preventDefault();
                
                // تأثير حركي عند النقر
                gsap.to(this, {
                    scale: 0.95,
                    duration: 0.2,
                    yoyo: true,
                    repeat: 1,
                    ease: "power1.inOut",
                    onComplete: () => {
                        window.location.href = this.href;
                    }
                });
            }
        });
    });

    // Touch device optimizations
    if ('ontouchstart' in window) {
        document.body.classList.add('touch-device');
    }
});
</script>
@endpush