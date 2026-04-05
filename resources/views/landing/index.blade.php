@extends('layouts.landing')

@section('title', 'Joni Motor - Service & Sparepart Mobil Terpercaya')

@section('styles')
<style>
:root {
    --red-900:#1a0505;--red-800:#220808;--red-700:#2d0c0c;--red-600:#3d1111;
    --red-500:#7f1d1d;--red-400:#b91c1c;--red-300:#dc2626;--red-200:#ef4444;
    --red-100:#fca5a5;--red-50:#fee2e2;
    --bg-primary:#0d0606;--bg-secondary:#130909;--bg-card:#1a0c0c;
    --bg-elevated:#230f0f;--bg-hover:#2d1414;
    --border:rgba(220,38,38,0.12);--border-hover:rgba(220,38,38,0.30);
    --border-glow:rgba(220,38,38,0.50);
    --text-primary:#fff1f1;--text-secondary:#c9a0a0;--text-muted:#7a5555;
    --accent:#dc2626;--accent-light:#ef4444;
    --accent-glow:rgba(220,38,38,0.35);--accent-faint:rgba(220,38,38,0.10);
    --gold:#f59e0b;--gold-glow:rgba(245,158,11,0.25);
    --gradient-red:linear-gradient(135deg,#dc2626,#b91c1c);
    --gradient-card:linear-gradient(145deg,#1a0c0c,#130909);
    --radius:16px;--radius-sm:10px;
    --transition:0.3s cubic-bezier(0.4,0,0.2,1);
    --font-main:'Outfit',sans-serif;
}
*,*::before,*::after{box-sizing:border-box;}
html{scroll-behavior:smooth;}
body{font-family:var(--font-main);background:var(--bg-primary);color:var(--text-primary);overflow-x:hidden;}
a{text-decoration:none;color:inherit;}
::-webkit-scrollbar{width:6px;}
::-webkit-scrollbar-track{background:var(--bg-primary);}
::-webkit-scrollbar-thumb{background:var(--red-500);border-radius:10px;}

/* ===== NAVBAR ===== */
.jm-navbar{
    background:rgba(13,6,6,0.85);
    backdrop-filter:blur(20px);
    border-bottom:1px solid var(--border);
    padding:14px 0;
    position:fixed;top:0;left:0;right:0;z-index:999;
    transition:all var(--transition);
}
.jm-navbar.scrolled{
    background:rgba(13,6,6,0.97);
    box-shadow:0 4px 30px rgba(0,0,0,0.5);
}
.navbar-brand-logo{
    display:flex;align-items:center;gap:12px;
}
.brand-icon-wrap{
    width:44px;height:44px;
    background:var(--gradient-red);
    border-radius:12px;
    display:flex;align-items:center;justify-content:center;
    box-shadow:0 0 20px var(--accent-glow);
    font-size:22px;color:#fff;
}
.brand-text-wrap .brand-name{
    font-size:20px;font-weight:800;color:var(--text-primary);line-height:1;
}
.brand-text-wrap .brand-sub{
    font-size:10px;color:var(--text-muted);font-weight:500;letter-spacing:1.5px;text-transform:uppercase;
}
.nav-link-jm{
    color:var(--text-secondary)!important;
    font-weight:500;font-size:14px;
    padding:6px 12px!important;
    border-radius:8px;
    transition:all var(--transition);
    position:relative;
}
.nav-link-jm:hover,.nav-link-jm.active{color:var(--text-primary)!important;}
.nav-link-jm::after{
    content:'';position:absolute;bottom:0;left:50%;transform:translateX(-50%);
    width:0;height:2px;background:var(--accent);border-radius:10px;
    transition:width var(--transition);
}
.nav-link-jm:hover::after,.nav-link-jm.active::after{width:60%;}
.btn-nav{
    background:var(--gradient-red);color:#fff!important;
    padding:8px 22px!important;border-radius:8px;font-weight:700!important;
    box-shadow:0 0 15px var(--accent-glow);
    transition:all var(--transition);
}
.btn-nav:hover{transform:translateY(-2px);box-shadow:0 0 25px var(--accent-glow);}
.btn-nav-outline{
    background:transparent;color:var(--accent-light)!important;
    border:1.5px solid var(--accent);
    padding:6px 20px!important;border-radius:8px;font-weight:700!important;
    transition:all var(--transition);display:inline-flex;align-items:center;
}
.btn-nav-outline:hover{
    background:var(--accent-faint);color:var(--text-primary)!important;
    transform:translateY(-2px);
}
.navbar-toggler{border:1px solid var(--border-hover)!important;color:var(--text-primary)!important;}
.navbar-toggler-icon{filter:invert(1);}

/* ===== HERO ===== */
.hero-section{
    min-height:100vh;
    background:radial-gradient(ellipse 80% 60% at 50% -10%,rgba(220,38,38,0.18) 0%,transparent 70%),
               linear-gradient(180deg,#0d0606 0%,#130909 100%);
    display:flex;align-items:center;
    position:relative;overflow:hidden;
    padding:120px 0 80px;
}
.hero-bg-grid{
    position:absolute;inset:0;
    background-image:linear-gradient(rgba(220,38,38,0.04) 1px,transparent 1px),
                     linear-gradient(90deg,rgba(220,38,38,0.04) 1px,transparent 1px);
    background-size:60px 60px;
    mask-image:radial-gradient(ellipse 80% 80% at 50% 0%,black 30%,transparent 100%);
}
.hero-orb{
    position:absolute;
    border-radius:50%;filter:blur(80px);pointer-events:none;
}
.hero-orb-1{width:500px;height:500px;background:rgba(220,38,38,0.12);top:-100px;right:-100px;}
.hero-orb-2{width:350px;height:350px;background:rgba(185,28,28,0.08);bottom:-50px;left:-80px;}
.hero-badge{
    display:inline-flex;align-items:center;gap:8px;
    background:var(--accent-faint);border:1px solid rgba(220,38,38,0.25);
    color:var(--accent-light);padding:6px 18px;border-radius:50px;
    font-size:13px;font-weight:600;letter-spacing:0.5px;margin-bottom:20px;
}
.hero-badge i{font-size:11px;animation:pulse-red 2s infinite;}
@keyframes pulse-red{0%,100%{color:var(--accent);}50%{color:var(--gold);}}
.hero-title{
    font-size:clamp(2.4rem,5vw,4rem);font-weight:900;
    line-height:1.1;letter-spacing:-1px;
    color:var(--text-primary);margin-bottom:20px;
}
.hero-title .highlight{
    color:var(--accent-light);
    text-shadow:0 0 40px rgba(220,38,38,0.5);
}
.hero-title .line2{
    background:linear-gradient(90deg,var(--text-primary),var(--text-secondary));
    -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
}
.hero-desc{
    color:var(--text-secondary);font-size:16px;line-height:1.75;
    max-width:520px;margin-bottom:36px;
}
.hero-buttons{display:flex;flex-wrap:wrap;gap:14px;margin-bottom:50px;}
.btn-hero-primary{
    background:var(--gradient-red);color:#fff;border:none;
    padding:15px 36px;border-radius:var(--radius-sm);
    font-weight:700;font-size:15px;font-family:var(--font-main);
    box-shadow:0 0 25px var(--accent-glow),0 4px 20px rgba(0,0,0,0.4);
    transition:all var(--transition);display:inline-flex;align-items:center;gap:10px;
    cursor:pointer;
}
.btn-hero-primary:hover{transform:translateY(-3px);box-shadow:0 0 40px var(--border-glow),0 8px 30px rgba(0,0,0,0.5);color:#fff;}
.btn-hero-outline{
    background:transparent;color:var(--text-primary);
    border:1.5px solid var(--border-hover);
    padding:14px 36px;border-radius:var(--radius-sm);
    font-weight:600;font-size:15px;font-family:var(--font-main);
    transition:all var(--transition);display:inline-flex;align-items:center;gap:10px;
    cursor:pointer;
}
.btn-hero-outline:hover{border-color:var(--accent);color:var(--accent-light);background:var(--accent-faint);transform:translateY(-3px);}
.hero-stats{display:flex;flex-wrap:wrap;gap:32px;}
.hero-stat-item .stat-num{
    font-size:2rem;font-weight:900;color:var(--accent-light);line-height:1;
}
.hero-stat-item .stat-label{font-size:12px;color:var(--text-muted);margin-top:4px;font-weight:500;}
.hero-stat-divider{width:1px;background:var(--border);align-self:stretch;}

/* Hero Visual */
.hero-visual{position:relative;}
.hero-car-card{
    background:var(--gradient-card);border:1px solid var(--border);
    border-radius:24px;padding:30px;
    box-shadow:0 30px 80px rgba(0,0,0,0.6),0 0 60px var(--accent-glow);
    position:relative;overflow:hidden;
}
.hero-car-card::before{
    content:'';position:absolute;inset:0;
    background:radial-gradient(ellipse 60% 40% at 50% 0%,rgba(220,38,38,0.08),transparent 70%);
}
.car-icon-display{
    font-size:120px;color:var(--accent);opacity:0.9;
    display:block;text-align:center;line-height:1;
    filter:drop-shadow(0 0 30px rgba(220,38,38,0.5));
    animation:float-car 4s ease-in-out infinite;
}
@keyframes float-car{0%,100%{transform:translateY(0);}50%{transform:translateY(-12px);}}
.hero-floating-badge{
    position:absolute;background:var(--bg-elevated);
    border:1px solid var(--border-hover);border-radius:12px;
    padding:10px 16px;display:flex;align-items:center;gap:10px;
    box-shadow:0 10px 30px rgba(0,0,0,0.4);
    animation:float-badge 3s ease-in-out infinite;
}
@keyframes float-badge{0%,100%{transform:translateY(0);}50%{transform:translateY(-8px);}}
.hero-floating-badge.badge-1{top:20px;left:-30px;animation-delay:0.5s;}
.hero-floating-badge.badge-2{bottom:40px;right:-20px;animation-delay:1s;}
.badge-icon-wrap{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;}
.badge-icon-wrap.red{background:rgba(220,38,38,0.2);color:var(--accent-light);}
.badge-icon-wrap.gold{background:rgba(245,158,11,0.2);color:var(--gold);}
.fb-title{font-size:13px;font-weight:700;color:var(--text-primary);}
.fb-sub{font-size:11px;color:var(--text-muted);}

/* ===== SERVICES ===== */
.services-section{
    padding:100px 0;background:var(--bg-secondary);
    border-top:1px solid var(--border);border-bottom:1px solid var(--border);
    position:relative;
}
.services-section::before{
    content:'';position:absolute;inset:0;
    background:radial-gradient(ellipse 50% 50% at 50% 0%,rgba(220,38,38,0.05),transparent 70%);
}
.service-card{
    background:var(--gradient-card);border:1px solid var(--border);
    border-radius:var(--radius);padding:32px 28px;
    transition:all var(--transition);height:100%;position:relative;overflow:hidden;
}
.service-card::after{
    content:'';position:absolute;inset:0;
    background:radial-gradient(circle at 0% 0%,rgba(220,38,38,0.06),transparent 60%);
    opacity:0;transition:opacity var(--transition);
}
.service-card:hover::after{opacity:1;}
.service-card:hover{
    border-color:var(--border-hover);
    transform:translateY(-6px);
    box-shadow:0 25px 60px rgba(0,0,0,0.5),0 0 30px var(--accent-glow);
}
.service-icon-wrap{
    width:64px;height:64px;border-radius:16px;
    background:rgba(220,38,38,0.12);border:1px solid rgba(220,38,38,0.2);
    display:flex;align-items:center;justify-content:center;
    font-size:30px;color:var(--accent-light);
    margin-bottom:22px;transition:all var(--transition);
}
.service-card:hover .service-icon-wrap{
    background:rgba(220,38,38,0.2);
    box-shadow:0 0 20px var(--accent-glow);
    transform:scale(1.05);
}
.service-title{font-size:19px;font-weight:700;color:var(--text-primary);margin-bottom:12px;}
.service-desc{font-size:14px;color:var(--text-secondary);line-height:1.7;margin-bottom:20px;}
.service-features{list-style:none;padding:0;margin:0;}
.service-features li{
    font-size:13px;color:var(--text-secondary);
    padding:5px 0;display:flex;align-items:center;gap:8px;
}
.service-features li i{color:var(--accent-light);font-size:12px;}

/* ===== WHY CHOOSE ===== */
.why-section{padding:100px 0;background:var(--bg-primary);}
.why-card{
    background:var(--bg-elevated);border:1px solid var(--border);
    border-radius:var(--radius);padding:28px 24px;
    display:flex;gap:20px;align-items:flex-start;
    transition:all var(--transition);height:100%;
}
.why-card:hover{border-color:var(--border-hover);transform:translateY(-4px);box-shadow:0 15px 40px rgba(0,0,0,0.4);}
.why-icon{
    width:50px;height:50px;min-width:50px;border-radius:12px;
    background:var(--accent-faint);border:1px solid rgba(220,38,38,0.2);
    display:flex;align-items:center;justify-content:center;
    font-size:22px;color:var(--accent-light);
}
.why-title{font-size:16px;font-weight:700;color:var(--text-primary);margin-bottom:8px;}
.why-desc{font-size:13px;color:var(--text-secondary);line-height:1.6;margin:0;}

/* Big visual column */
.why-visual-wrap{position:relative;height:100%;}
.why-main-card{
    background:var(--gradient-card);border:1px solid var(--border-hover);
    border-radius:24px;padding:40px;height:100%;min-height:480px;
    display:flex;flex-direction:column;justify-content:center;
    box-shadow:0 30px 80px rgba(0,0,0,0.5),0 0 40px var(--accent-glow);
    position:relative;overflow:hidden;
}
.why-main-card::before{
    content:'';position:absolute;top:-60px;right:-60px;
    width:250px;height:250px;border-radius:50%;
    background:rgba(220,38,38,0.08);filter:blur(60px);
}
.mechanic-icon{font-size:100px;text-align:center;display:block;margin-bottom:24px;filter:drop-shadow(0 0 25px rgba(220,38,38,0.4));}
.why-stat-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:24px;}
.why-stat-box{
    background:var(--bg-primary);border:1px solid var(--border);
    border-radius:12px;padding:16px;text-align:center;
}
.why-stat-box .num{font-size:24px;font-weight:900;color:var(--accent-light);}
.why-stat-box .lbl{font-size:11px;color:var(--text-muted);margin-top:4px;}

/* ===== SPAREPART ===== */
.sparepart-section{
    padding:100px 0;
    background:var(--bg-secondary);
    border-top:1px solid var(--border);
}
.part-card{
    background:var(--gradient-card);border:1px solid var(--border);
    border-radius:var(--radius);overflow:hidden;
    transition:all var(--transition);height:100%;
}
.part-card:hover{border-color:var(--border-hover);transform:translateY(-6px);box-shadow:0 20px 50px rgba(0,0,0,0.5),0 0 25px var(--accent-glow);}
.part-img{
    background:var(--bg-elevated);height:160px;
    display:flex;align-items:center;justify-content:center;
    font-size:64px;border-bottom:1px solid var(--border);
    position:relative;overflow:hidden;
}
.part-img::after{
    content:'';position:absolute;inset:0;
    background:radial-gradient(circle at 50% 50%,rgba(220,38,38,0.06),transparent 70%);
}
.part-body{padding:20px 18px;}
.part-name{font-size:16px;font-weight:700;color:var(--text-primary);margin-bottom:6px;}
.part-brand{font-size:12px;color:var(--text-muted);margin-bottom:12px;}
.part-price{font-size:20px;font-weight:800;color:var(--accent-light);}
.part-price-orig{font-size:12px;color:var(--text-muted);text-decoration:line-through;margin-left:8px;}
.part-badge-new{
    display:inline-flex;background:rgba(220,38,38,0.15);border:1px solid rgba(220,38,38,0.3);
    color:var(--accent-light);font-size:10px;font-weight:700;
    padding:2px 10px;border-radius:20px;margin-bottom:12px;
}
.part-badge-sale{
    display:inline-flex;background:rgba(245,158,11,0.15);border:1px solid rgba(245,158,11,0.3);
    color:var(--gold);font-size:10px;font-weight:700;
    padding:2px 10px;border-radius:20px;margin-bottom:12px;
}

/* ===== TESTIMONIALS ===== */
.testi-section{padding:100px 0;background:var(--bg-primary);}
.testi-card{
    background:var(--gradient-card);border:1px solid var(--border);
    border-radius:var(--radius);padding:30px 26px;
    transition:all var(--transition);height:100%;
}
.testi-card:hover{border-color:var(--border-hover);transform:translateY(-5px);box-shadow:0 20px 50px rgba(0,0,0,0.4);}
.testi-stars{color:var(--gold);font-size:14px;margin-bottom:16px;letter-spacing:2px;}
.testi-text{font-size:14px;color:var(--text-secondary);line-height:1.8;margin-bottom:22px;font-style:italic;}
.testi-author{display:flex;align-items:center;gap:14px;}
.testi-avatar{
    width:44px;height:44px;border-radius:50%;
    background:var(--gradient-red);
    display:flex;align-items:center;justify-content:center;
    font-size:18px;font-weight:700;color:#fff;flex-shrink:0;
}
.testi-name{font-size:14px;font-weight:700;color:var(--text-primary);}
.testi-sub{font-size:12px;color:var(--text-muted);}

/* ===== CTA ===== */
.cta-section{
    padding:100px 0;
    background:radial-gradient(ellipse 70% 70% at 50% 50%,rgba(220,38,38,0.12) 0%,transparent 70%),
               var(--bg-secondary);
    border-top:1px solid var(--border);
    text-align:center;
}
.cta-title{font-size:clamp(2rem,4vw,3rem);font-weight:900;color:var(--text-primary);margin-bottom:16px;}
.cta-title span{color:var(--accent-light);}
.cta-desc{color:var(--text-secondary);font-size:16px;max-width:500px;margin:0 auto 40px;}

/* ===== FOOTER ===== */
.jm-footer{
    background:var(--bg-secondary);
    border-top:1px solid var(--border);
    padding:60px 0 0;
}
.footer-brand{margin-bottom:20px;}
.footer-brand .brand-icon-wrap{width:48px;height:48px;font-size:24px;border-radius:14px;}
.footer-desc{color:var(--text-muted);font-size:14px;line-height:1.75;max-width:280px;}
.footer-title{font-size:14px;font-weight:700;color:var(--text-primary);text-transform:uppercase;letter-spacing:1px;margin-bottom:20px;}
.footer-links{list-style:none;padding:0;margin:0;}
.footer-links li{margin-bottom:10px;}
.footer-links a{color:var(--text-muted);font-size:14px;transition:color var(--transition);}
.footer-links a:hover{color:var(--accent-light);}
.footer-contact-item{display:flex;align-items:flex-start;gap:12px;margin-bottom:14px;}
.fci-icon{color:var(--accent-light);font-size:15px;margin-top:2px;flex-shrink:0;}
.fci-text{color:var(--text-muted);font-size:13px;line-height:1.5;}
.footer-bottom{
    border-top:1px solid var(--border);
    padding:20px 0;margin-top:50px;
    display:flex;flex-wrap:wrap;gap:12px;
    align-items:center;justify-content:space-between;
}
.footer-bottom p{color:var(--text-muted);font-size:13px;margin:0;}
.footer-bottom a{color:var(--accent-light);transition:opacity var(--transition);}
.footer-bottom a:hover{opacity:0.7;}
.social-links{display:flex;gap:10px;}
.social-link{
    width:36px;height:36px;border-radius:10px;
    background:var(--bg-elevated);border:1px solid var(--border);
    display:flex;align-items:center;justify-content:center;
    color:var(--text-muted);font-size:16px;
    transition:all var(--transition);
}
.social-link:hover{border-color:var(--accent);color:var(--accent-light);background:var(--accent-faint);}

/* ===== SECTION HEADER ===== */
.section-badge{
    display:inline-flex;align-items:center;gap:8px;
    background:var(--accent-faint);border:1px solid rgba(220,38,38,0.25);
    color:var(--accent-light);padding:6px 18px;border-radius:50px;
    font-size:13px;font-weight:600;letter-spacing:0.5px;margin-bottom:16px;
}
.section-title{font-size:clamp(1.8rem,3.5vw,2.7rem);font-weight:800;line-height:1.2;color:var(--text-primary);}
.section-title span{color:var(--accent-light);}
.section-subtitle{color:var(--text-secondary);font-size:15px;line-height:1.75;max-width:540px;}
.divider-red{width:50px;height:3px;background:var(--gradient-red);border-radius:10px;margin:14px 0 24px;box-shadow:0 0 12px var(--accent-glow);}

/* ===== SCROLL TOP ===== */
#scrollTop{
    position:fixed;bottom:28px;right:28px;
    width:44px;height:44px;border-radius:12px;
    background:var(--gradient-red);border:none;
    color:#fff;font-size:18px;
    display:flex;align-items:center;justify-content:center;
    cursor:pointer;z-index:999;
    box-shadow:0 0 20px var(--accent-glow);
    opacity:0;pointer-events:none;
    transition:all var(--transition);
}
#scrollTop.show{opacity:1;pointer-events:auto;}
#scrollTop:hover{transform:translateY(-3px);box-shadow:0 0 30px var(--border-glow);}

/* RESPONSIVE */
@media(max-width:991px){
    .hero-section{padding:100px 0 60px;}
    .hero-visual{margin-top:50px;}
    .hero-floating-badge.badge-1{left:-10px;}
    .hero-floating-badge.badge-2{right:-10px;}
}
@media(max-width:768px){
    .hero-stats{gap:20px;}
    .hero-title{font-size:2rem;}
    .hero-stat-divider{display:none;}
    .why-main-card{min-height:300px;}
}
</style>
@endsection

@section('navbar')
<nav class="jm-navbar" id="mainNav">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between w-100">
            <a href="#hero" class="navbar-brand-logo">
                <div class="brand-icon-wrap"><i class="bi bi-car-front-fill"></i></div>
                <div class="brand-text-wrap">
                    <div class="brand-name">Joni Motor</div>
                    <div class="brand-sub">Service & Sparepart</div>
                </div>
            </a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" id="navToggler">
                <i class="bi bi-list" style="color:var(--text-primary);font-size:22px;"></i>
            </button>
            <div class="collapse navbar-collapse d-lg-flex align-items-center gap-1 justify-content-center" id="navMenu" style="flex:1;">
                <a href="#services" class="nav-link-jm">Layanan</a>
                <a href="#sparepart" class="nav-link-jm">Sparepart</a>
                <a href="#why" class="nav-link-jm">Tentang Kami</a>
                <a href="#testimonials" class="nav-link-jm">Testimoni</a>
                <a href="#contact" class="nav-link-jm">Kontak</a>
            </div>
            <div class="d-none d-lg-flex align-items-center gap-2">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn-nav text-decoration-none">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                @else
                    <a href="{{ Route::has('login') ? route('login') : url('login') }}" class="btn-nav-outline text-decoration-none">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Login
                    </a>
                    <a href="{{ Route::has('register') ? route('register') : url('register') }}" class="btn-nav text-decoration-none">
                        <i class="bi bi-person-plus me-2"></i> Register
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
@endsection

@section('content')

{{-- ===== HERO ===== --}}
<section class="hero-section" id="hero">
    <div class="hero-bg-grid"></div>
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="container position-relative">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #10b981; border-radius: 12px; margin-top: -30px; margin-bottom: 20px;">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="filter: invert(1);"></button>
            </div>
        @endif
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="hero-badge">
                    <i class="bi bi-circle-fill"></i>
                    Bengkel Terpercaya Sejak 2005
                </div>
                <h1 class="hero-title">
                    <span class="highlight">Service Mobil</span><br>
                    <span class="line2">Profesional &</span><br>
                    Terjangkau
                </h1>
                <p class="hero-desc">
                    Joni Motor hadir dengan teknisi berpengalaman, peralatan modern, dan sparepart berkualitas. Kepuasan Anda adalah prioritas utama kami.
                </p>
                <div class="hero-buttons">
                    <a href="#contact" class="btn-hero-primary">
                        <i class="bi bi-calendar2-check"></i> Booking Sekarang
                    </a>
                    <a href="#services" class="btn-hero-outline">
                        <i class="bi bi-play-circle"></i> Lihat Layanan
                    </a>
                </div>
                <div class="hero-stats">
                    <div class="hero-stat-item">
                        <div class="stat-num">20+</div>
                        <div class="stat-label">Tahun Pengalaman</div>
                    </div>
                    <div class="hero-stat-divider"></div>
                    <div class="hero-stat-item">
                        <div class="stat-num">5K+</div>
                        <div class="stat-label">Pelanggan Puas</div>
                    </div>
                    <div class="hero-stat-divider"></div>
                    <div class="hero-stat-item">
                        <div class="stat-num">15+</div>
                        <div class="stat-label">Mekanik Ahli</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="150">
                <div class="hero-visual">
                    <div class="hero-car-card">
                        <i class="bi bi-car-front car-icon-display"></i>
                        <div class="text-center mt-3">
                            <div style="font-size:16px;font-weight:700;color:var(--text-primary);">Perawatan Terbaik</div>
                            <div style="font-size:13px;color:var(--text-muted);margin-top:5px;">untuk kendaraan kesayangan Anda</div>
                        </div>
                    </div>
                    <div class="hero-floating-badge badge-1">
                        <div class="badge-icon-wrap red"><i class="bi bi-shield-check"></i></div>
                        <div>
                            <div class="fb-title">Garansi Service</div>
                            <div class="fb-sub">3 Bulan / 5.000 km</div>
                        </div>
                    </div>
                    <div class="hero-floating-badge badge-2">
                        <div class="badge-icon-wrap gold"><i class="bi bi-star-fill"></i></div>
                        <div>
                            <div class="fb-title">Rating 4.9/5</div>
                            <div class="fb-sub">500+ Ulasan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== SERVICES ===== --}}
<section class="services-section" id="services">
    <div class="container position-relative">
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="section-badge mx-auto"><i class="bi bi-tools"></i> Layanan Kami</div>
            <h2 class="section-title mb-2">Layanan <span>Service</span> Lengkap</h2>
            <div class="divider-red mx-auto"></div>
            <p class="section-subtitle mx-auto">Kami menyediakan berbagai layanan perawatan dan perbaikan kendaraan dengan standar profesional.</p>
        </div>
        <div class="row g-4">
            @php
            $services = [
                ['icon'=>'bi-gear-wide-connected','title'=>'Tune Up Mesin','desc'=>'Perawatan menyeluruh mesin agar performa optimal dan konsumsi BBM efisien.','features'=>['Pengecekan busi','Ganti filter udara','Setting karburator/injektor','Cek sistem pengapian']],
                ['icon'=>'bi-droplet-fill','title'=>'Ganti Oli & Filter','desc'=>'Penggantian oli mesin, oli transmisi, dan filter dengan produk berkualitas tinggi.','features'=>['Oli mesin premium','Oli gardan/transmisi','Filter oli & udara','Pembersihan bak oli']],
                ['icon'=>'bi-lightning-charge','title'=>'Sistem Kelistrikan','desc'=>'Diagnosa dan perbaikan sistem kelistrikan kendaraan secara menyeluruh.','features'=>['Aki/baterai','Alternator & starter','Sistem sensor','Kabel body']],
                ['icon'=>'bi-disc','title'=>'Rem & Suspensi','desc'=>'Pemeriksaan dan penggantian komponen rem serta suspensi untuk keselamatan berkendara.','features'=>['Kampas rem depan & belakang','Minyak rem','Shock absorber','Tie rod & ball joint']],
                ['icon'=>'bi-thermometer-sun','title'=>'AC Kendaraan','desc'=>'Servis, pengisian freon, dan perbaikan sistem pendingin kendaraan Anda.','features'=>['Cuci AC','Isi freon','Ganti filter kabin','Kompressor AC']],
                ['icon'=>'bi-paint-bucket','title'=>'Body & Cat','desc'=>'Perbaikan body kendaraan dan pengecatan ulang dengan hasil rapi dan sempurna.','features'=>['Dempul & cat','Perbaikan penyok','Poles & coating','Proteksi cat']],
            ];
            @endphp
            @foreach($services as $i => $svc)
            <div class="col-md-6 col-xl-4" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi {{ $svc['icon'] }}"></i>
                    </div>
                    <h3 class="service-title">{{ $svc['title'] }}</h3>
                    <p class="service-desc">{{ $svc['desc'] }}</p>
                    <ul class="service-features">
                        @foreach($svc['features'] as $f)
                        <li><i class="bi bi-check-circle-fill"></i>{{ $f }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== WHY CHOOSE ===== --}}
<section class="why-section" id="why">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="why-main-card">
                    <i class="bi bi-person-gear mechanic-icon text-center d-block" style="color:var(--accent-light);"></i>
                    <h3 style="font-size:22px;font-weight:800;text-align:center;margin-bottom:8px;">Tim Mekanik Profesional</h3>
                    <p style="color:var(--text-muted);font-size:13px;text-align:center;">Tersertifikasi & berpengalaman lebih dari 20 tahun</p>
                    <div class="why-stat-grid">
                        <div class="why-stat-box"><div class="num">15+</div><div class="lbl">Mekanik Ahli</div></div>
                        <div class="why-stat-box"><div class="num">5K+</div><div class="lbl">Pelanggan</div></div>
                        <div class="why-stat-box"><div class="num">500+</div><div class="lbl">Jenis Sparepart</div></div>
                        <div class="why-stat-box"><div class="num">4.9★</div><div class="lbl">Rating</div></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <div class="section-badge"><i class="bi bi-patch-check-fill"></i> Kenapa Pilih Kami</div>
                <h2 class="section-title mb-2">Mengapa <span>Joni Motor</span><br>Pilihan Tepat?</h2>
                <div class="divider-red"></div>
                <p class="section-subtitle mb-5">Kami berkomitmen memberikan layanan terbaik dengan standar kualitas internasional dan harga yang bersahabat.</p>
                <div class="row g-3">
                    @php
                    $whys = [
                        ['icon'=>'bi-shield-check','title'=>'Garansi Resmi','desc'=>'Setiap pekerjaan bergaransi 3 bulan atau 5.000 km, mana yang tercapai lebih dulu.'],
                        ['icon'=>'bi-clock-history','title'=>'Servis Cepat','desc'=>'Dengan tim dan peralatan lengkap, servis ringan selesai dalam 2-3 jam.'],
                        ['icon'=>'bi-currency-dollar','title'=>'Harga Transparan','desc'=>'Estimasi biaya diberikan di awal, tanpa biaya tersembunyi atau kejutan di akhir.'],
                        ['icon'=>'bi-cpu','title'=>'Alat Modern','desc'=>'Menggunakan scanner diagnostik terkini untuk analisa masalah yang akurat.'],
                        ['icon'=>'bi-box-seam','title'=>'Sparepart Original','desc'=>'Hanya menggunakan sparepart berkualitas dari merek terpercaya dan bergaransi.'],
                        ['icon'=>'bi-headset','title'=>'Konsultasi Gratis','desc'=>'Tim kami siap konsultasi masalah kendaraan Anda via WhatsApp atau telepon.'],
                    ];
                    @endphp
                    @foreach($whys as $j => $why)
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ $j * 60 }}">
                        <div class="why-card">
                            <div class="why-icon"><i class="bi {{ $why['icon'] }}"></i></div>
                            <div>
                                <h4 class="why-title">{{ $why['title'] }}</h4>
                                <p class="why-desc">{{ $why['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== SPAREPART ===== --}}
<section class="sparepart-section" id="sparepart">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="section-badge mx-auto"><i class="bi bi-box-seam"></i> Toko Sparepart</div>
            <h2 class="section-title mb-2">Sparepart <span>Berkualitas</span></h2>
            <div class="divider-red mx-auto"></div>
            <p class="section-subtitle mx-auto">Ratusan jenis sparepart original dan aftermarket tersedia untuk berbagai merek kendaraan.</p>
        </div>
        <div class="row g-4">
            @php
            $parts = [
                ['icon'=>'⚙️','name'=>'Kampas Rem Brembo','brand'=>'Brembo / Original','price'=>'Rp 185.000','orig'=>'Rp 240.000','badge'=>'sale'],
                ['icon'=>'🔋','name'=>'Aki GS Astra 45Ah','brand'=>'GS Astra','price'=>'Rp 560.000','orig'=>null,'badge'=>'new'],
                ['icon'=>'💧','name'=>'Oli Shell Helix 4L','brand'=>'Shell','price'=>'Rp 210.000','orig'=>'Rp 265.000','badge'=>'sale'],
                ['icon'=>'🔩','name'=>'Busi NGK Iridium','brand'=>'NGK','price'=>'Rp 95.000','orig'=>null,'badge'=>'new'],
                ['icon'=>'🌬️','name'=>'Filter AC Cabin','brand'=>'Denso / Original','price'=>'Rp 75.000','orig'=>'Rp 110.000','badge'=>'sale'],
                ['icon'=>'🔧','name'=>'Timing Belt Kit','brand'=>'Gates / Original','price'=>'Rp 380.000','orig'=>null,'badge'=>'new'],
                ['icon'=>'🛞','name'=>'Shock Absorber KYB','brand'=>'KYB','price'=>'Rp 650.000','orig'=>'Rp 800.000','badge'=>'sale'],
                ['icon'=>'🌡️','name'=>'Thermostat Mesin','brand'=>'Aisin / Original','price'=>'Rp 120.000','orig'=>null,'badge'=>'new'],
            ];
            @endphp
            @foreach($parts as $k => $part)
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $k * 60 }}">
                <div class="part-card">
                    <div class="part-img">{{ $part['icon'] }}</div>
                    <div class="part-body">
                        @if($part['badge'] === 'new')
                            <div class="part-badge-new">NEW</div>
                        @else
                            <div class="part-badge-sale">SALE</div>
                        @endif
                        <div class="part-name">{{ $part['name'] }}</div>
                        <div class="part-brand"><i class="bi bi-tag me-1"></i>{{ $part['brand'] }}</div>
                        <div class="d-flex align-items-baseline">
                            <span class="part-price">{{ $part['price'] }}</span>
                            @if($part['orig'])
                                <span class="part-price-orig">{{ $part['orig'] }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="#contact" class="btn-hero-primary">
                <i class="bi bi-whatsapp"></i> Tanya Ketersediaan Sparepart
            </a>
        </div>
    </div>
</section>

{{-- ===== TESTIMONIALS ===== --}}
<section class="testi-section" id="testimonials">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="section-badge mx-auto"><i class="bi bi-chat-quote-fill"></i> Testimoni</div>
            <h2 class="section-title mb-2">Apa Kata <span>Pelanggan</span> Kami</h2>
            <div class="divider-red mx-auto"></div>
        </div>
        <div class="row g-4">
            @php
            $testis = [
                ['name'=>'Budi Santoso','sub'=>'Toyota Avanza','text'=>'Sudah 5 tahun langganan di sini. Mekaniknya jujur, harga sesuai, hasil service memuaskan. Gak pernah kecewa!','stars'=>5,'init'=>'B'],
                ['name'=>'Dewi Rahayu','sub'=>'Honda Jazz','text'=>'AC mobil saya sudah lama tidak dingin, dibawa ke Joni Motor langsung ketahuan masalahnya dan selesai dalam sehari. Recommended!','stars'=>5,'init'=>'D'],
                ['name'=>'Hendra Wijaya','sub'=>'Mitsubishi Pajero','text'=>'Sparepart lengkap dan original. Harga lebih murah dari dealer tapi kualitas sama. Service juga ramah dan profesional.','stars'=>5,'init'=>'H'],
                ['name'=>'Siti Nurhaliza','sub'=>'Suzuki Ertiga','text'=>'Tune up di sini terasa bedanya langsung. Tarikan lebih ringan dan bensin lebih irit. Harga terjangkau pula!','stars'=>5,'init'=>'S'],
                ['name'=>'Rizky Pratama','sub'=>'Daihatsu Xenia','text'=>'Garansi 3 bulannya beneran dipakai waktu ada masalah. Langsung ditangani tanpa biaya tambahan. Top!','stars'=>5,'init'=>'R'],
                ['name'=>'Maya Indah','sub'=>'Honda CRV','text'=>'Konsultasi gratis via WA sangat membantu. Dijelaskan dengan sabar apa yang perlu diperbaiki. Terima kasih Joni Motor!','stars'=>5,'init'=>'M'],
            ];
            @endphp
            @foreach($testis as $t => $testi)
            <div class="col-md-6 col-xl-4" data-aos="fade-up" data-aos-delay="{{ $t * 80 }}">
                <div class="testi-card">
                    <div class="testi-stars">
                        @for($s=0;$s<$testi['stars'];$s++) ★ @endfor
                    </div>
                    <p class="testi-text">"{{ $testi['text'] }}"</p>
                    <div class="testi-author">
                        <div class="testi-avatar">{{ $testi['init'] }}</div>
                        <div>
                            <div class="testi-name">{{ $testi['name'] }}</div>
                            <div class="testi-sub"><i class="bi bi-car-front me-1"></i>{{ $testi['sub'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== CTA ===== --}}
<section class="cta-section" id="contact">
    <div class="container" data-aos="zoom-in">
        <div class="section-badge mx-auto mb-4 d-inline-flex"><i class="bi bi-calendar2-check"></i> Booking Mudah</div>
        <h2 class="cta-title">Siap Servis <span>Kendaraan</span><br>Anda Hari Ini?</h2>
        <p class="cta-desc">Hubungi kami sekarang untuk booking service atau konsultasi masalah kendaraan Anda. Kami siap membantu!</p>
        <div class="d-flex flex-wrap gap-3 justify-content-center mb-5">
            <a href="https://wa.me/6281234567890?text=Halo%20Joni%20Motor,%20saya%20ingin%20booking%20service" target="_blank" class="btn-hero-primary" style="font-size:16px;padding:16px 40px;">
                <i class="bi bi-whatsapp"></i> Chat WhatsApp
            </a>
            <a href="tel:+6281234567890" class="btn-hero-outline" style="font-size:16px;padding:15px 40px;">
                <i class="bi bi-telephone"></i> Telepon Langsung
            </a>
        </div>
        <div class="row justify-content-center g-4 mt-2">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div style="background:var(--bg-elevated);border:1px solid var(--border);border-radius:var(--radius);padding:28px;text-align:center;">
                    <div style="font-size:36px;margin-bottom:12px;">📍</div>
                    <div style="font-size:15px;font-weight:700;margin-bottom:6px;">Alamat</div>
                    <div style="font-size:13px;color:var(--text-muted);">Jl. Raya Bengkel No. 99<br>Kota Anda, Indonesia</div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div style="background:var(--bg-elevated);border:1px solid var(--border);border-radius:var(--radius);padding:28px;text-align:center;">
                    <div style="font-size:36px;margin-bottom:12px;">⏰</div>
                    <div style="font-size:15px;font-weight:700;margin-bottom:6px;">Jam Operasional</div>
                    <div style="font-size:13px;color:var(--text-muted);">Senin – Sabtu: 08.00 – 17.00<br>Minggu: 08.00 – 14.00</div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div style="background:var(--bg-elevated);border:1px solid var(--border);border-radius:var(--radius);padding:28px;text-align:center;">
                    <div style="font-size:36px;margin-bottom:12px;">📞</div>
                    <div style="font-size:15px;font-weight:700;margin-bottom:6px;">Hubungi Kami</div>
                    <div style="font-size:13px;color:var(--text-muted);">+62 812-3456-7890<br>jonimotorbengkel@gmail.com</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Scroll Top --}}
<button id="scrollTop" title="Kembali ke atas"><i class="bi bi-arrow-up"></i></button>

@endsection

@section('footer')
<footer class="jm-footer">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="footer-brand d-flex align-items-center gap-3 mb-3">
                    <div class="brand-icon-wrap"><i class="bi bi-car-front-fill"></i></div>
                    <div class="brand-text-wrap">
                        <div class="brand-name" style="font-size:22px;">Joni Motor</div>
                        <div class="brand-sub">Service & Sparepart</div>
                    </div>
                </div>
                <p class="footer-desc">Bengkel mobil terpercaya dengan pengalaman lebih dari 20 tahun. Melayani service dan penjualan sparepart dengan standar kualitas terbaik.</p>
                <div class="social-links mt-4">
                    <a href="#" class="social-link" title="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-link" title="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-link" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                    <a href="#" class="social-link" title="YouTube"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-2">
                <h5 class="footer-title">Layanan</h5>
                <ul class="footer-links">
                    <li><a href="#services">Tune Up Mesin</a></li>
                    <li><a href="#services">Ganti Oli</a></li>
                    <li><a href="#services">Sistem Rem</a></li>
                    <li><a href="#services">Service AC</a></li>
                    <li><a href="#services">Kelistrikan</a></li>
                    <li><a href="#services">Body & Cat</a></li>
                </ul>
            </div>
            <div class="col-sm-6 col-lg-2">
                <h5 class="footer-title">Sparepart</h5>
                <ul class="footer-links">
                    <li><a href="#sparepart">Kampas Rem</a></li>
                    <li><a href="#sparepart">Aki & Baterai</a></li>
                    <li><a href="#sparepart">Filter & Oli</a></li>
                    <li><a href="#sparepart">Busi & Kabel</a></li>
                    <li><a href="#sparepart">Suspensi</a></li>
                    <li><a href="#sparepart">Pendingin</a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h5 class="footer-title">Kontak & Lokasi</h5>
                <div class="footer-contact-item">
                    <i class="bi bi-geo-alt-fill fci-icon"></i>
                    <span class="fci-text">Jl. Raya Bengkel No. 99, Kota Anda, Indonesia</span>
                </div>
                <div class="footer-contact-item">
                    <i class="bi bi-telephone-fill fci-icon"></i>
                    <span class="fci-text">+62 812-3456-7890</span>
                </div>
                <div class="footer-contact-item">
                    <i class="bi bi-envelope-fill fci-icon"></i>
                    <span class="fci-text">jonimotorbengkel@gmail.com</span>
                </div>
                <div class="footer-contact-item">
                    <i class="bi bi-clock-fill fci-icon"></i>
                    <span class="fci-text">Sen–Sab 08.00–17.00 | Min 08.00–14.00</span>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© {{ date('Y') }} <a href="#">Joni Motor</a>. Hak cipta dilindungi undang-undang.</p>
            <p>Dibuat dengan <span style="color:var(--accent-light);">♥</span> untuk pelanggan setia kami</p>
        </div>
    </div>
</footer>
@endsection

@section('scripts')
<script>
// Navbar scroll effect
const nav = document.getElementById('mainNav');
window.addEventListener('scroll', () => {
    nav.classList.toggle('scrolled', window.scrollY > 50);
});

// Scroll Top button
const scrollBtn = document.getElementById('scrollTop');
window.addEventListener('scroll', () => {
    scrollBtn.classList.toggle('show', window.scrollY > 400);
});
scrollBtn.addEventListener('click', () => window.scrollTo({top:0, behavior:'smooth'}));

// Active nav link on scroll
const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('.nav-link-jm[href^="#"]');
window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(s => {
        if(window.scrollY >= s.offsetTop - 100) current = s.id;
    });
    navLinks.forEach(l => {
        l.classList.toggle('active', l.getAttribute('href') === '#' + current);
    });
});
</script>
@endsection
