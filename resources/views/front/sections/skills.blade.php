 <!-- Skills Section with Galaxy Design -->
    <section id="skills" class="skillsSection">
        <div class="galaxyBackground">
            <div class="stars"></div>
            <div class="stars"></div>
            <div class="stars"></div>
            <div class="nebula"></div>
            <div class="galaxyCore"></div>
        </div>

        <div class="container">
            <div class="header">
                <h2 class="title">
                    <span class="titleGradient">My Skills Universe</span>
                </h2>
                <div class="titleUnderline"></div>
                <p class="subtitle">
                    Exploring the vast galaxy of my technical expertise and creative abilities
                </p>
            </div>

            <div class="galaxyContainer">
                <!-- المدارات الثابتة -->
                <div class="staticOrbits">
                    <div class="staticOrbit" style="--orbit-radius: 180; --orbit-color: rgba(99, 102, 241, 0.3)"></div>
                    <div class="staticOrbit" style="--orbit-radius: 250; --orbit-color: rgba(168, 85, 247, 0.3)"></div>
                    <div class="staticOrbit" style="--orbit-radius: 320; --orbit-color: rgba(236, 72, 153, 0.3)"></div>
                </div>

                <!-- مركز المجرة -->
                <div class="galaxyCenter" style="--center-size: 180px">
                    <div class="blackHole"></div>
                    <div class="accretionDisk"></div>
                    <div class="centerGlow">
                        <span>Core</span>
                        <span>Skills</span>
                    </div>
                </div>

                <!-- النجوم العائمة -->
                <div class="floatingStars">
                    @for($i = 0; $i < 15; $i++)
                    <div class="star" style="
                        --star-size: {{ rand(1, 3) }}px;
                        --star-x: {{ rand(0, 100) }}%;
                        --star-y: {{ rand(0, 100) }}%;
                        --star-delay: {{ $i * 0.5 }}s;
                    "></div>
                    @endfor
                </div>

                <!-- الكوايب (المهارات) -->
                <div class="orbitSystem">
                    <!-- Frontend Planet -->
                    <div class="planet" style="
                        --planet-size: 70px;
                        --planet-color: #6366f1;
                        --planet-glow: #6366f1;
                        transform: rotate(0deg) translateX(180px) rotate(0deg);
                    " data-skill="frontend">
                        <div class="planetBody">
                            <div class="planetSurface"></div>
                            <div class="planetGlow"></div>
                            <div class="planetIcon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="planetRings">
                            <div class="ring"></div>
                            <div class="ring"></div>
                        </div>
                        <div class="moon" style="--moon-delay: 0s"></div>
                    </div>

                    <!-- Backend Planet -->
                    <div class="planet" style="
                        --planet-size: 65px;
                        --planet-color: #a855f7;
                        --planet-glow: #a855f7;
                        transform: rotate(120deg) translateX(250px) rotate(-120deg);
                    " data-skill="backend">
                        <div class="planetBody">
                            <div class="planetSurface"></div>
                            <div class="planetGlow"></div>
                            <div class="planetIcon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2"/>
                                </svg>
                            </div>
                        </div>
                        <div class="moon" style="--moon-delay: 2s"></div>
                    </div>

                    <!-- Database Planet -->
                    <div class="planet" style="
                        --planet-size: 60px;
                        --planet-color: #ec4899;
                        --planet-glow: #ec4899;
                        transform: rotate(240deg) translateX(180px) rotate(-240deg);
                    " data-skill="database">
                        <div class="planetBody">
                            <div class="planetSurface"></div>
                            <div class="planetGlow"></div>
                            <div class="planetIcon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                                </svg>
                            </div>
                        </div>
                        <div class="moon" style="--moon-delay: 4s"></div>
                    </div>

                    <!-- Mobile Planet -->
                    <div class="planet" style="
                        --planet-size: 55px;
                        --planet-color: #f59e0b;
                        --planet-glow: #f59e0b;
                        transform: rotate(60deg) translateX(320px) rotate(-60deg);
                    " data-skill="mobile">
                        <div class="planetBody">
                            <div class="planetSurface"></div>
                            <div class="planetGlow"></div>
                            <div class="planetIcon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="5" y="2" width="14" height="20" rx="2" ry="2"/>
                                    <path d="M12 18h.01"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- DevOps Planet -->
                    <div class="planet" style="
                        --planet-size: 58px;
                        --planet-color: #10b981;
                        --planet-glow: #10b981;
                        transform: rotate(180deg) translateX(250px) rotate(-180deg);
                    " data-skill="devops">
                        <div class="planetBody">
                            <div class="planetSurface"></div>
                            <div class="planetGlow"></div>
                            <div class="planetIcon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2"/>
                                    <path d="M12 8v8"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Design Planet -->
                    <div class="planet" style="
                        --planet-size: 52px;
                        --planet-color: #ef4444;
                        --planet-glow: #ef4444;
                        transform: rotate(300deg) translateX(320px) rotate(-300deg);
                    " data-skill="design">
                        <div class="planetBody">
                            <div class="planetSurface"></div>
                            <div class="planetGlow"></div>
                            <div class="planetIcon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </div>
                        </div>
                        <div class="moon" style="--moon-delay: 1s"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Planet Card (سيتم التحكم بها عبر JavaScript) -->
        <div class="planetCard" id="planetCard" style="display: none;">
            <div class="cardHeader">
                <div class="cardIcon" id="cardIcon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                </div>
                <div class="cardTitle">
                    <h3 id="cardSkillTitle">Frontend Development</h3>
                    <div class="planetType" id="cardSkillType">Web Technology</div>
                </div>
            </div>
            <div class="cardStats" id="cardStats">
                <!-- سيتم ملؤها عبر JavaScript -->
            </div>
            <div class="planetFeatures" id="planetFeatures">
                <!-- سيتم ملؤها عبر JavaScript -->
            </div>
        </div>
    </section>

    <link href="{{ asset('front/css/skills.css') }}" rel="stylesheet">
