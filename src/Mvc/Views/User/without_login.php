<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/scss/style.css">
    <title>Document</title>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        const resgister = {
            open:false,
            first_name:'',
            last_name: '',
            email: '',
            password:'',
            birthday: '',
            retype_password:'',
            gender:'',
            error: [],
            isLoading:false,
            isSuccess:false,
            validate:function() {
                this.error = [];

                if (this.retype_password != this.password)
                {
                    this.error.push('Xac thuc mat khau khong chinh xac!');
                
                }
                if(this.error.length)
                {
                    return;
                }

            },
         
            register_user:async function() {
                this.validate();
                this.isLoading = true;
                let data = {
                    first_name: this.first_name,
                    last_name: this.last_name,
                    email: this.email,
                    password: this.password,
                    birthday: this.birthday,
                    gender: this.gender,

                };
                console.log(data);

                let response = await fetch('http://127.0.0.1:8080/api/register', {
                    method:"POST",
                    headers: {
                               "Content-Type": "application/json",  
                                 "Accept":       "application/json" 
                            },
                    body:JSON.stringify(data),
                });
                if(!response.ok)
                {
                    this.isLoading =false;
                    throw new Error('Can not register!')
                }
                let responseData = await response.json();
                if(responseData.status == 'success')
                {
                  this.isSuccess = true;
                }
                this.isLoading =false;
             
                console.log(responseData);
            

            },

         
            
        }

        const login_user = {
            email: '',
            password: '',
            error:[],
            login_user:async function()
            {
                this.error = [];
                this.isLoading = true;
                let data = {
                    email: this.email,
                    password: this.password,
                };
                let response = await fetch('http://127.0.0.1:8080/api/login', {
                    method:"POST",
                    headers: {
                               "Content-Type": "application/json",  
                                 "Accept":       "application/json" 
                            },
                    body:JSON.stringify(data),
                });
                
                let responseData =await response.json();
                if(!response.ok)
                {
                    this.isLoading = false;
                    throw new Error('Cannot login!')

                }
                if(responseData.status == 'success')
                {
                    window.location.href = 'http://127.0.0.1:8080';

                }else{
                    this.error =[responseData.error]


                }
                
             

                           

                        }
        }
    </script>

</head>

<body>
    <main>
        <section class="home">
            <header id="header">

                <div class="header_logo">
                    <img src="./assets/images/logo.png" alt="logo">
                </div>
                <div class="header_nav">
                    <div class="header_nav-item">
                        Giới thiệu
                        <svg height="1em" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1"
                            viewBox="0 0 512 512" width="1em" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <polygon points="396.6,160 416,180.7 256,352 96,180.7 115.3,160 256,310.5 " />
                        </svg>
                    </div>
                    <div class="header_nav-item">
                        Tin tuc
                        <svg height="1em" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1"
                            viewBox="0 0 512 512" width="1em" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <polygon points="396.6,160 416,180.7 256,352 96,180.7 115.3,160 256,310.5 " />
                        </svg>
                    </div>
                    <div class="header_nav-item">
                        Su kien
                        <svg height="1em" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1"
                            viewBox="0 0 512 512" width="1em" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <polygon points="396.6,160 416,180.7 256,352 96,180.7 115.3,160 256,310.5 " />
                        </svg>
                    </div>
                </div>
                <div class="header_search">
                    <svg height="1.5em" width="1.5em" id="Layer_1" style="enable-background:new 0 0 64 64;" version="1.1"
                        viewBox="0 0 64 64" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <style type="text/css">
                            .st0 {
                                fill: #134563;
                            }
                        </style>
                        <g>
                            <g id="Icon-Search" transform="translate(30.000000, 230.000000)">
                                <path class="st0"
                                    d="M-2.3-182.9c-10.7,0-19.5-8.7-19.5-19.5c0-10.7,8.7-19.5,19.5-19.5s19.5,8.7,19.5,19.5     C17.1-191.6,8.4-182.9-2.3-182.9L-2.3-182.9z M-2.3-219c-9.2,0-16.7,7.5-16.7,16.7c0,9.2,7.5,16.7,16.7,16.7s16.7-7.5,16.7-16.7     C14.3-211.5,6.8-219-2.3-219L-2.3-219z"
                                    id="Fill-1" />
                                <polyline class="st0" id="Fill-2"
                                    points="23.7,-174.2 10.1,-187.7 12.3,-189.9 25.8,-176.3 23.7,-174.2    " />
                            </g>
                        </g>
                    </svg>
                    <input type="text" placeholder="Tìm kiếm" class="bg-transparent border-0 outline-none ">
        
                </div>
                <div x-data="{register:false, login:false}" class="header_auth">
                    <div  x-data='resgister' class="header_auth-register">
                        <button @click="register=true" class="button button-outline">
                            <svg height="1.5em" width="1.5em" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <title />
                                <circle cx="12" cy="8" fill="#464646" r="4" />
                                <path d="M20,19v1a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V19a6,6,0,0,1,6-6h4A6,6,0,0,1,20,19Z"
                                    fill="#464646" />
                            </svg>
                            Đăng ký
                        </button>
                        <form  @submit.prevent='register_user' x-cloak x-show="register && !isSuccess" @click.outside="register=false"
                            class="register__form" :class="'error' && error.length>0">
                            <div class="form-header">
                                Đăng ký
                                <svg @click="register=false" height="1em" id="Layer_1" style="enable-background:new 0 0 512 512;"
                                    version="1.1" viewBox="0 0 512 512" width="1em" xml:space="preserve"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path
                                        d="M437.5,386.6L306.9,256l130.6-130.6c14.1-14.1,14.1-36.8,0-50.9c-14.1-14.1-36.8-14.1-50.9,0L256,205.1L125.4,74.5  c-14.1-14.1-36.8-14.1-50.9,0c-14.1,14.1-14.1,36.8,0,50.9L205.1,256L74.5,386.6c-14.1,14.1-14.1,36.8,0,50.9  c14.1,14.1,36.8,14.1,50.9,0L256,306.9l130.6,130.6c14.1,14.1,36.8,14.1,50.9,0C451.5,423.4,451.5,400.6,437.5,386.6z" />
                                </svg>
                            </div>
                            <div class="form_body">
                                <div class="form_body-group ">
                                    <input x-model='first_name' required type="text" placeholder="Họ">
                                    <input x-model='last_name' required type="text" placeholder="Tên">
                                </div>
                                <div class="form_body-group">
                                    <input x-model='email' type="email" required placeholder="Email hoặc số điện thoại">
                                </div>
                                <div class="form_body-group">
                                    <input x-model='password' required type="password" placeholder="Mật khẩu ">
                                </div>
                                <div class="form_body-group">
                                    <input x-model="retype_password" type="password" required placeholder="Nhập lại mật khẩu ">
                                </div>
                                <hr>
                                <div class="birtday">
                                    <label>Ngày sinh: </label>
                                    <input x-model='birthday' required type="date" placeholder="dd/m/YY">
                                </div>
                                <hr>
                                <div class="gender">
                                    <label for="">Gender: </label>
                                    <select x-model='gender' required name="" id="" class="w-full p-3 rounded-3xl">
                                        <option value="">Giới tính</option>
                                        <option value="nam">Nam</option>
        
                                        <option value="nu">Nu </option>
        
                                        <option value="lhac">Khac</option>
        
                                    </select>
                                </div>
                                <template x-for="er in error">
                                    <div x-text='er'></div>


                                </template>
                                <div class="container-button">
                                    
                                <svg x-show="isLoading" height='1.5em' width='1.5em' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200">
                                    <radialGradient id="a7" cx=".66" fx=".66" cy=".3125" fy=".3125" gradientTransform="scale(1.5)">
                                        <stop offset="0" stop-color="#FF156D"></stop>
                                        <stop offset=".3" stop-color="#FF156D" stop-opacity=".9"></stop><stop offset=".6" stop-color="#FF156D" stop-opacity=".6"></stop><stop offset=".8" stop-color="#FF156D" stop-opacity=".3"></stop><stop offset="1" stop-color="#FF156D" stop-opacity="0"></stop></radialGradient><circle transform-origin="center" fill="none" stroke="url(#a7)" stroke-width="15" stroke-linecap="round" stroke-dasharray="200 1000" stroke-dashoffset="0" cx="100" cy="100" r="70"><animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="2" values="360;0" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform></circle><circle transform-origin="center" fill="none" opacity=".2" stroke="#FF156D" stroke-width="15" stroke-linecap="round" cx="100" cy="100" r="70"></circle></svg>
                                    <button class="button button-primary">Đăng ký </button>
                                </div>
        
                            </div>
                        </form>
                        <div class="register__form-success" x-cloak x-show="register && isSuccess" @click.outside="isSuccess=false"
                           >
                            <div class='container__close_icon'>
                                <svg @click="isSuccess=false" height="1em" id="Layer_1" style="enable-background:new 0 0 512 512;"
                                    version="1.1" viewBox="0 0 512 512" width="1em" xml:space="preserve"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path
                                        d="M437.5,386.6L306.9,256l130.6-130.6c14.1-14.1,14.1-36.8,0-50.9c-14.1-14.1-36.8-14.1-50.9,0L256,205.1L125.4,74.5  c-14.1-14.1-36.8-14.1-50.9,0c-14.1,14.1-14.1,36.8,0,50.9L205.1,256L74.5,386.6c-14.1,14.1-14.1,36.8,0,50.9  c14.1,14.1,36.8,14.1,50.9,0L256,306.9l130.6,130.6c14.1,14.1,36.8,14.1,50.9,0C451.5,423.4,451.5,400.6,437.5,386.6z" />
                                </svg>
                            </div>
                            <div class="register__form__content-success">
                                <svg  height="100px" width="100px" id="Icons" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <defs>
                                        <style>
                                            .cls-1 {
                                                fill: url(#linear-gradient);
                                            }
        
                                            .cls-2 {
                                                fill: #a4ffa6;
                                            }
                                        </style>
                                        <linearGradient gradientUnits="userSpaceOnUse" id="linear-gradient" x1="12" x2="12"
                                            y1="0.957" y2="22.957">
                                            <stop offset="0" stop-color="#71ff7b" />
                                            <stop offset="1" stop-color="#27f42c" />
                                        </linearGradient>
                                    </defs>
                                    <circle class="cls-1" cx="12" cy="12" r="11" />
                                    <path class="cls-2"
                                        d="M10,17a1,1,0,0,1-.707-.293l-3-3a1,1,0,0,1,1.414-1.414L10,14.586l6.293-6.293a1,1,0,0,1,1.414,1.414l-7,7A1,1,0,0,1,10,17Z" />
                                </svg>
                                    <div class=content> Chúc mừng bạn
                                        đã đăng ký thành công!</div>
                                <div class="container-button">
                                    <button @click="register=false; login=true"
                                        class="button button-primary">Đăng nhập ngay </button>
        
                                </div>
        
                            </div>
                        </div>
                    </div>
        
                    <div   class="header_auth-login">
                        <button @click="login=true" class="button button-outline">
                        <svg height="1.5em" width="1.5em" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title/><circle cx="12" cy="8" fill="#464646" r="4"/><path d="M20,19v1a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V19a6,6,0,0,1,6-6h4A6,6,0,0,1,20,19Z" fill="#464646"/>
                        </svg>
                        Đăng nhập
                        </button>
                        <form x-data="login_user" @submit.prevent='login_user'  x-cloak x-show="login" @click.outside="login=false" class="login__form">
                            <div class="login__form__header">
                                Đăng nhập
                                <svg @click="login=false" height="1em" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="1em" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M437.5,386.6L306.9,256l130.6-130.6c14.1-14.1,14.1-36.8,0-50.9c-14.1-14.1-36.8-14.1-50.9,0L256,205.1L125.4,74.5  c-14.1-14.1-36.8-14.1-50.9,0c-14.1,14.1-14.1,36.8,0,50.9L205.1,256L74.5,386.6c-14.1,14.1-14.1,36.8,0,50.9  c14.1,14.1,36.8,14.1,50.9,0L256,306.9l130.6,130.6c14.1,14.1,36.8,14.1,50.9,0C451.5,423.4,451.5,400.6,437.5,386.6z"/></svg>
                            </div>
                            <div class="login__form__body ">
                                <div class="form__group">
                                    <input x-model='email' class="p-3 bg-gray-200 rounded-3xl placeholder:text-black outline-none border-0 w-full " type="text" placeholder="Email hoặc số điện thoại">
                                </div>
                                <div class="form__group">
                                    <input x-model='password' class="p-3 bg-gray-200 rounded-3xl placeholder:text-black outline-none border-0 w-full " type="password" placeholder="Mật khẩu ">
                                </div>
                                <template x-for="er in error">
                                    <div x-text='er'></div>
                                </template>
                                <div class="container-button">
                                    <button  class="button button-primary">Đăng nhập  </button>
                                </div>
                                <div class="register__now">
                                    Bạn chưa có tài khoản? <span>Đăng ký ngay </span>
                                </div>
        
                               
        
                    
        
                            </div>
                        </form>
                    </div>
                </div>
        
            </header>
            <div class="content">
                   <div class="content__heading">
                       PET CARE
                   </div>
                   <div class="content__hero">
                
                    Nơi gửi trọn yêu thương
                    tới bé yêu của bạn
                   </div>
                   <div class="container-button">
                    <button class="button button-primary">Tìm hiểu thêm </button>
                   </div>            
            </div>
        </section>
       <section class="description">
        <div class="description__thumnail">
        </div>
        <div class="description__content">
            <div class="description__content__container">
                <h3>Chúng tôi yêu các bé</h3>
                <p>
                    Pet Care là nhà cung cấp dịch vụ chăm sóc và chiều chuộng thú cưng số 1. Chúng tôi đã phục vụ hơn hàng ngàn thú cưng và cha mẹ thú cưng mọi nơi
                </p>
            </div>
           

        </div>

       </section>
       <section class="services">
        <div class="heading">
            Dich vu
        </div>
        <ul class="service__lists">
            <li class="service__lists__item">
                <div class="item__thumnail"></div>                
                <div class="item__description">
                    Mỗi bức ảnh là một thông điệp về tình cảm trong sáng, đáng yêu giữa trẻ nhỏ và những người bạn động vật.
                </div>
            </li>
            <li class="service__lists__item">
                <div class="item__thumnail"></div>                
                <div class="item__description">
                    Ảnh cũng khiến người lớn bồi hồi nhớ lại thời thơ ấu với những người bạn động vật của mình.
                </div>
            </li>
            <li class="service__lists__item">
                <div class="item__thumnail"></div>                
                <div class="item__description">
                    Thông qua bộ ảnh, bà mẹ trẻ muốn gửi gắm câu chuyện đẹp về tình bạn giữa con người và động vật.
                </div>
            </li>
        
            

        </ul>

       </section>
       <section class="join-us">
        

       </section>

     </main>
    <footer id="footer">
        <div class="footer__container">
            <div class="footer__item">
                <div class="footer__item__label">Mailing Address</div>
                <div class="footer__item__content">175 TAY SON, DONG DA, HA NOI</div>
            </div>
            <div class="footer__item">
                <div class="footer__item__label">Email Address</div>
                <div class="footer__item__content">petcare@tlu.edu.com</div>
            </div>
            <div class="footer__item">
                <div class="footer__item__label">Phone Number</div>
                <div class="footer__item__content">(+84) 753861429</div>
            </div>
    
    
        </div>
    

    </footer>
</body>

</html>