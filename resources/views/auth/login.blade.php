@extends('layouts.auth')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
    }

    .login-container {
        display: flex;
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        overflow: hidden;
        max-width: 900px;
        width: 90%;
        animation: slideUp 0.6s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .illustration-section {
        flex: 1;
        background: #f0f0f0;
        padding: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .shapes-container {
        position: relative;
        width: 100%;
        height: 300px;
    }

    .shape {
        position: absolute;
        border-radius: 20px;
        animation: float 3s ease-in-out infinite;
        transition: transform 0.1s ease-out;
    }

    .shape-green {
        width: 120px;
        height: 140px;
        background: #00A651;
        left: 20%;
        top: 0;
        border-radius: 20px 20px 50px 20px;
        transform: rotate(-15deg);
        animation: float 3s ease-in-out infinite;
    }

    .shape-orange {
        width: 140px;
        height: 100px;
        background: #FF7675;
        left: 0;
        bottom: 0;
        border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
        animation: float 3.5s ease-in-out infinite;
    }

    .shape-black {
        width: 90px;
        height: 110px;
        background: #2D3436;
        left: 35%;
        bottom: 10%;
        border-radius: 40% 40% 20px 20px;
        animation: float 2.8s ease-in-out infinite;
    }

    .shape-yellow {
        width: 100px;
        height: 120px;
        background: #FDCB6E;
        right: 10%;
        bottom: 5%;
        border-radius: 30px 30px 60px 30px;
        animation: float 3.2s ease-in-out infinite;
    }

    .eyes {
        position: absolute;
        top: 40%;
        width: 100%;
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    .eye {
        width: 20px;
        height: 20px;
        background: white;
        border-radius: 50%;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pupil {
        width: 10px;
        height: 10px;
        background: #2D3436;
        border-radius: 50%;
        position: absolute;
        transition: transform 0.1s ease-out;
    }

    .shape-green .eye {
        width: 16px;
        height: 16px;
    }

    .shape-green .pupil {
        width: 8px;
        height: 8px;
    }

    .shape-orange .eye {
        width: 14px;
        height: 14px;
    }

    .shape-orange .pupil {
        width: 7px;
        height: 7px;
    }

    .shape-black .eye {
        width: 16px;
        height: 16px;
    }

    .shape-black .pupil {
        width: 8px;
        height: 8px;
        background: #FDCB6E;
    }

    .shape-yellow .eye {
        width: 14px;
        height: 14px;
    }

    .shape-yellow .pupil {
        width: 7px;
        height: 7px;
    }

    .mouth {
        position: absolute;
        bottom: 25%;
        left: 50%;
        transform: translateX(-50%);
        width: 30px;
        height: 15px;
        border: 3px solid rgba(255,255,255,0.8);
        border-top: none;
        border-radius: 0 0 30px 30px;
    }

    .shape-black .mouth {
        border-color: rgba(255,255,255,0.8);
    }

    .shape-orange .mouth,
    .shape-green .mouth,
    .shape-yellow .mouth {
        border-color: rgba(45,52,54,0.6);
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0) rotate(var(--rotation, 0deg));
        }
        50% {
            transform: translateY(-20px) rotate(var(--rotation, 0deg));
        }
    }

    @keyframes shake {
        0% { transform: translateX(0) rotate(0deg); }
        15% { transform: translateX(-20px) rotate(-20deg); }
        30% { transform: translateX(20px) rotate(20deg); }
        45% { transform: translateX(-20px) rotate(-20deg); }
        60% { transform: translateX(20px) rotate(20deg); }
        75% { transform: translateX(-15px) rotate(-15deg); }
        90% { transform: translateX(15px) rotate(15deg); }
        100% { transform: translateX(0) rotate(0deg); }
    }

    .shake-animation {
        animation: shake 0.8s cubic-bezier(0.36, 0.07, 0.19, 0.97) both !important;
    }

    @keyframes nod {
        0% { transform: translateY(0); }
        20% { transform: translateY(-25px); }
        40% { transform: translateY(0); }
        60% { transform: translateY(-25px); }
        80% { transform: translateY(0); }
        100% { transform: translateY(0); }
    }

    .nod-animation {
        animation: nod 1s ease-in-out both !important;
    }

    .form-section {
        flex: 1;
        padding: 60px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .logo-icon {
        width: 50px;
        height: auto;
        margin-bottom: 20px;
    }

    h2 {
        font-size: 28px;
        margin-bottom: 10px;
        color: #2D3436;
    }

    .subtitle {
        color: #636E72;
        margin-bottom: 30px;
        font-size: 14px;
    }

    .input-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #2D3436;
        font-size: 14px;
        font-weight: 500;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 12px;
        border: 1px solid #DFE6E9;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        height: 44px;
        box-sizing: border-box;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
        outline: none;
        border-color: #00A651;
        box-shadow: 0 0 0 3px rgba(0, 166, 81, 0.1);
    }

    input.error {
        border-color: #FF7675;
        animation: inputShake 0.3s ease-in-out;
    }

    @keyframes inputShake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-10px); }
        75% { transform: translateX(10px); }
    }

    .error-message {
        color: #FF7675;
        font-size: 12px;
        margin-top: 5px;
        display: none;
    }

    .error-message.show {
        display: block;
    }

    .remember-forgot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        font-size: 14px;
    }

    .remember {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .forgot-password {
        color: #00A651;
        text-decoration: none;
        transition: opacity 0.3s;
    }

    .forgot-password:hover {
        opacity: 0.8;
    }

    .login-btn {
        width: 100%;
        padding: 14px;
        background: #2D3436;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 15px;
    }

    .login-btn:hover {
        background: #000;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .login-btn:active {
        transform: translateY(0);
    }

    @media (max-width: 768px) {
        .login-container {
            flex-direction: column;
        }

        .illustration-section {
            padding: 40px;
        }

        .shapes-container {
            height: 200px;
        }

        .form-section {
            padding: 40px 30px;
        }
    }
</style>

<div class="login-container">
    <div class="illustration-section">
        <div class="shapes-container" id="shapesContainer">
            <div class="shape shape-green" style="--rotation: -15deg;" data-shape="green">
                <div class="eyes">
                    <div class="eye"><div class="pupil" data-pupil></div></div>
                    <div class="eye"><div class="pupil" data-pupil></div></div>
                </div>
                <div class="mouth"></div>
            </div>
            <div class="shape shape-orange" style="--rotation: 5deg;" data-shape="orange">
                <div class="eyes">
                    <div class="eye"><div class="pupil" data-pupil></div></div>
                    <div class="eye"><div class="pupil" data-pupil></div></div>
                </div>
                <div class="mouth"></div>
            </div>
            <div class="shape shape-black" style="--rotation: 10deg;" data-shape="black">
                <div class="eyes">
                    <div class="eye"><div class="pupil" data-pupil></div></div>
                    <div class="eye"><div class="pupil" data-pupil></div></div>
                </div>
                <div class="mouth"></div>
            </div>
            <div class="shape shape-yellow" style="--rotation: -10deg;" data-shape="yellow">
                <div class="eyes">
                    <div class="eye"><div class="pupil" data-pupil></div></div>
                    <div class="eye"><div class="pupil" data-pupil></div></div>
                </div>
                <div class="mouth"></div>
            </div>
        </div>
    </div>

    <div class="form-section">
        <img src="{{asset('image/logo.png')}}" alt="Logo" class="logo-icon">
        <h2>Selamat Datang!</h2>
        <p class="subtitle">Silakan masukkan detail Anda</p>

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="@error('email') error @enderror"
                       value="{{ old('email') }}" placeholder="nama@email.com" required autocomplete="email" autofocus>
                @error('email')
                    <div class="error-message show">{{ $message }}</div>
                @enderror
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="@error('password') error @enderror"
                       placeholder="Masukkan password" required autocomplete="current-password">
                @error('password')
                    <div class="error-message show">{{ $message }}</div>
                @enderror
            </div>

            <div class="remember-forgot">
                <label class="remember">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span>Ingat saya selama 30 hari</span>
                </label>
                <a href="#" class="forgot-password">Lupa password?</a>
            </div>

            <button type="submit" class="login-btn">Masuk</button>
        </form>
    </div>
</div>

<script>
    const pupils = document.querySelectorAll('[data-pupil]');
    const shapes = document.querySelectorAll('[data-shape]');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');

    document.addEventListener('mousemove', (e) => {
        pupils.forEach(pupil => {
            const eye = pupil.parentElement;
            const eyeRect = eye.getBoundingClientRect();
            const eyeCenterX = eyeRect.left + eyeRect.width / 2;
            const eyeCenterY = eyeRect.top + eyeRect.height / 2;

            const deltaX = e.clientX - eyeCenterX;
            const deltaY = e.clientY - eyeCenterY;
            const angle = Math.atan2(deltaY, deltaX);
            const distance = Math.min(5, Math.sqrt(deltaX * deltaX + deltaY * deltaY) / 20);

            const pupilX = Math.cos(angle) * distance;
            const pupilY = Math.sin(angle) * distance;

            pupil.style.transform = `translate(${pupilX}px, ${pupilY}px)`;
        });

        shapes.forEach(shape => {
            if (!shape.classList.contains('shake-animation')) {
                const shapeRect = shape.getBoundingClientRect();
                const shapeCenterX = shapeRect.left + shapeRect.width / 2;
                const shapeCenterY = shapeRect.top + shapeRect.height / 2;

                const deltaX = e.clientX - shapeCenterX;
                const deltaY = e.clientY - shapeCenterY;

                const maxTilt = 8;
                const tiltX = (deltaX / window.innerWidth) * maxTilt;
                const tiltY = (deltaY / window.innerHeight) * maxTilt;

                shape.style.transform = `rotate(${tiltX}deg)`;
            }
        });
    });

    @if($errors->any())
        shapes.forEach((shape, index) => {
            shape.style.transform = '';
            shape.classList.add('shake-animation');
            setTimeout(() => {
                shape.classList.remove('shake-animation');
            }, 800);
        });
    @endif
</script>
@endsection
