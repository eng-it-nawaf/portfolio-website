<section class="heroSection" id="home">
        <div class="heroContent">
            <div class="backgroundElements">
                <div class="floatingOrb" style="--delay: '0s'"></div>
                <div class="floatingOrb" style="--delay: '2s'"></div>
                <div class="floatingOrb" style="--delay: '4s'"></div>
                <div class="gridOverlay"></div>
            </div>
            
            <div class="heroCard">
                <div class="cardGlow"></div>
                
                <div class="heroLayout">
                    <!-- العمود النصي -->
                    <div class="textContent">
                        <!-- شارة الترحيب -->
                        <div class="titleContainer">
                            <h1 class="heroTitle">
                                <span class="gradientText">{{ __('Hello, I am') }} {{ $profile->name }}</span>
                            </h1>
                        </div>

                        <!-- العنوان الرئيسي -->
                        
                        <div class="welcomeBadge">
                            <div class="badgeDot"></div>
                            <span >{{ $profile->title }}</span>
                            
                        </div>

                        <!-- الوصف -->
                        <p class="heroDescription">
                            {{ $profile->about }}
                        </p>

                        <!-- أزرار CTA -->
                        {{--  <div class="ctaButtons">
                            <a href="projects" class="btn btn-primary">
                                {{ __('View My Work') }}
                            </a>
                            <a href="contact" class="btn btn-outline">
                                {{ __('Contact Me') }}
                            </a>
                        </div>  --}}
                        

                        

                        <!-- معلومات الاتصال -->
                        @if($profile->phone)
                        <div class="contactBadge">
                            <div class="phoneIcon">📱</div>
                            <span>{{ $profile->phone }}</span>
                        </div>
                        @endif
                    </div>

                    <!-- عمود الصورة -->
                    <div class="imageContent">
                        <div class="imageFrame">
                            <div class="imageWrapper">
                                <img src="{{ asset('storage/' . $profile->photo) }}" 
                                     alt="{{ $profile->name }}" 
                                     class="profileImage">
                                <div class="imageShine"></div>
                            </div>
                            
                            <!-- العناصر الزخرفية -->
                            <div class="decorativeElements">
                                <div class="decorativeDot" style="--size: '20px'; --x: '-10%'; --y: '20%'"></div>
                                <div class="decorativeDot" style="--size: '15px'; --x: '90%'; --y: '80%'"></div>
                                <div class="decorativeLine" style="--rotation: '45deg'; --x: '80%'; --y: '10%'"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>