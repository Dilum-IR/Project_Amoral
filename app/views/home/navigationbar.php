<!-- Navigation Bar -->

<section class="home-section" id="navbar">
    <style>
        .nav-icons {
            width: 240px !important;
            display: flex;
            justify-content: space-between ;
            align-items: center !important;
            gap: 10px;
            margin-right: 15px !important;
            margin-top: -10px !important;
        }

        .black-btn:hover {
            position: relative;
            color:  #191919;
          
            background-color:white;
        
        }


        .nav-sign-btn {
            position: relative;
            font-size: 14px;
           
            width: max-content !important;
            height: 40px;
            border-radius: 30px;
            border-style: none;
            transition: 0.3s ease;
            
            cursor: pointer;
            align-items: flex-end;
            justify-content: center;
            align-self: center;
            padding: 8px 20px;
            
        }
        .black-btn{
            background-color: #191919;
            color: white;
            border-style: solid;
            border-color: white;
            border-width: 1px;
        }
        .white-btn{
            background-color: white;
            color: #191919 !important;
            border-style: solid;
            border-color: white;
            border-width: 1px;
        }
        .icon{
            font-size: 22px !important;
        }
    </style>
    <nav>
        <div class="company-logo">
            <img src="<?= ROOT ?>/assets/images/amorallogo.png" alt="#" class="logo">
        </div>
        <div class="nav-icons">
            <a href="<?= ROOT ?>/tool" class="nav-link tooltips" value="Create Design">
                <i class='bx bxs-t-shirt icon'> </i>
                <!-- <span class="bell-notification">Design</span> -->
            </a>
            <button class="nav-sign-btn black-btn" onclick="showPopup('popup1')">Sign Up</button>
            <a href="<?= ROOT ?>/signin" class="nav-sign-btn white-btn">Sign In</a>
            <!-- <button class="">Sign Up</button> -->
            <!-- <button class="nav-sign-btn">Sign In</button> -->


            <!-- <a href="<?= ROOT ?>/signin" class="nav-link tooltips" value="Profile">
                <i class='bx bxs-user icon'></i>
               <span class="chat-notification">Sign Up</span> 
            </a> -->


            <!-- <a href="#" class="nav-link-profile">
              <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8cGVvcGxlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="">
            </a> -->
        </div>

    </nav>
</section>