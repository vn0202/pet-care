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
            open: false,
            first_name: '',
            last_name: '',
            email: '',
            password: '',
            birthday: '',
            retype_password: '',
            gender: '',
            error: [],
            isLoading: false,
            isSuccess: false,
            validate: function() {
                this.error = [];

                if (this.retype_password != this.password) {
                    this.error.push('Xac thuc mat khau khong chinh xac!');

                }
                if (this.error.length) {
                    return;
                }

            },

            register_user: async function() {
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
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify(data),
                });
                if (!response.ok) {
                    this.isLoading = false;
                    throw new Error('Can not register!')
                }
                let responseData = await response.json();
                if (responseData.status == 'success') {
                    this.isSuccess = true;
                }
                this.isLoading = false;

                console.log(responseData);


            },



        }
        const login_user = {
            email: '',
            password: '',
            error:[],
            isLoading: false,
            login_user: async function() {
                this.error = [];
                this.isLoading = true;
                let data = {
                    email: this.email,
                    password: this.password,
                };
                let response = await fetch('http://127.0.0.1:8080/api/login', {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify(data),
                });
             

                let responseData = await response.json();
                if (!response.ok) {
                    throw new Error('Cannot login!')
                }
                if(responseData.status == 'success'){

                }else{
                    this.error.push = responseData.error;
                }
            }
        }
    </script>

</head>

<body>
    <main >
        <section class="home login">
            <header id="header" class="login">

                <div class="header_logo">
                    <img src="./assets/images/logo.png" alt="logo">
                </div>
                <div class="header_nav">
                    <div class="header_nav-item">
                        Trang chu
                        <svg height="1em" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="1em" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <polygon points="396.6,160 416,180.7 256,352 96,180.7 115.3,160 256,310.5 " />
                        </svg>
                    </div>
                    <div class="header_nav-item">
                        Tin tuc
                        <svg height="1em" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="1em" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <polygon points="396.6,160 416,180.7 256,352 96,180.7 115.3,160 256,310.5 " />
                        </svg>
                    </div>
                    <div class="header_nav-item">
                        Dich vu
                        <svg height="1em" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="1em" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <polygon points="396.6,160 416,180.7 256,352 96,180.7 115.3,160 256,310.5 " />
                        </svg>
                    </div>
                </div>
                <div class="header_search">
                    <svg height="1.5em" width="1.5em" id="Layer_1" style="enable-background:new 0 0 64 64;" version="1.1" viewBox="0 0 64 64" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <style type="text/css">
                            .st0 {
                                fill: #134563;
                            }
                        </style>
                        <g>
                            <g id="Icon-Search" transform="translate(30.000000, 230.000000)">
                                <path class="st0" d="M-2.3-182.9c-10.7,0-19.5-8.7-19.5-19.5c0-10.7,8.7-19.5,19.5-19.5s19.5,8.7,19.5,19.5     C17.1-191.6,8.4-182.9-2.3-182.9L-2.3-182.9z M-2.3-219c-9.2,0-16.7,7.5-16.7,16.7c0,9.2,7.5,16.7,16.7,16.7s16.7-7.5,16.7-16.7     C14.3-211.5,6.8-219-2.3-219L-2.3-219z" id="Fill-1" />
                                <polyline class="st0" id="Fill-2" points="23.7,-174.2 10.1,-187.7 12.3,-189.9 25.8,-176.3 23.7,-174.2    " />
                            </g>
                        </g>
                    </svg>
                    <input type="text" placeholder="Tìm kiếm" class="bg-transparent border-0 outline-none ">

                </div>
               <div x-data="{open:false}" class="menu__user">
                <div @click="open=!open"  class="menu__user__name">
                <img src="../../../../assets/images/service1.jpg" alt="">
                </div>
                <div x-cloak x-show="open" @click.outside="open=false" class="menu__user__setting">
                    <div class="item">Nguyen Dinh</div>
                    <div  class="item">Settings</div>
                    <a href="http://127.0.0.1:8080/logout"  class="item">Logout</a>
                </div>
               </div>
            
            </header>
       
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