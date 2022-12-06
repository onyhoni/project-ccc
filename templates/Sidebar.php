<div class="lg:w-[200px]  left-0 absolute lg:bottom-0 top-0 w-full lg:fixed flex lg:flex-col lg:shadow-lg justify-between lg:justify-start header bg-white lg:bg-opacity-100">
    <div class="w-[140px] h-[80px] lg:h-[140px] lg:bg-[#E1EDFC] rounded-full lg:mx-auto lg:mt-7 flex">
        <img src="img/JNE.png" alt="JNE" class="w-[100px] h-[50px] m-4 lg:m-auto">
    </div>
    <div class="m-4 lg:hidden flex">
        <i class="fa-solid fa-bell text-3xl hover:text-primary flex items-center mr-2"></i>
        <button id="hamburger" name="hamburger" type="button" class="block  right-4">
            <span class="w-[30px] h-[2px] my-2 block bg-black origin-top-left transition duration-300 ease-in-out"></span>
            <span class="w-[30px] h-[2px] my-2 block bg-black transition duration-300 ease-in-out"></span>
            <span class="w-[30px] h-[2px] my-2 block bg-black origin-bottom-left transition duration-300 ease-in-out"></span>
        </button>
        <nav id="nav-menu" class="hidden absolute py-5 bg-white shadow-lg rounded-lg max-w-[250px] w-full right-4 top-full">
            <ul class="block">
                <li class="group">
                    <a href="index.php" class="text-base font-semibold text-slate-800 py-2 mx-8 flex group-hover:text-primary">Dashboard</a>
                </li>
                <li class="group">
                    <a href="Activites2.php" class="text-base font-semibold text-slate-800 py-2 mx-8 flex group-hover:text-primary">Activities</a>
                </li>
                <?php if ($_SESSION['type_user'] !== 'Staff') : ?>
                    <li class="group">
                        <a href="user_m.php" class="text-base font-semibold text-slate-800 py-2 mx-8 flex group-hover:text-primary">User
                            Maintenance</a>
                    </li>
                    <li class="group">
                        <a href="setting.php" class="text-base font-semibold text-slate-800 py-2 mx-8 flex group-hover:text-primary">Setting</a>
                    </li>
                <?php endif; ?>
                <li class="group">
                    <a href="report.php" class="text-base font-semibold text-slate-800 py-2 mx-8 flex group-hover:text-primary">Report
                        Management</a>
                </li>
                <li class="group">
                    <a href="login.php" class="text-base font-semibold text-slate-800 py-2 mx-8 flex group-hover:text-primary">Logout</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="hidden lg:block">
        <a href="index.php">
            <div class="w-[80px] h-[70px] bg-[#E1EDFC]  mt-7 mx-auto flex items-center justify-center hover:bg-blue-200">
                <div class="flex flex-col">
                    <i class="fa-solid fa-house mx-auto text-[#0F56B3] text-xl"></i>
                    <span class="text-[#0F56B3] text-[12px] mx-auto font-bold mt-2">Dashboard</span>
                </div>
            </div>
        </a>

        <a href="Activites2.php">
            <div class="w-[80px] h-[70px] bg-[#E1EDFC]  mt-7 mx-auto flex items-center justify-center hover:bg-blue-200">
                <div class="flex flex-col">
                    <i class="fa-solid fa-bolt mx-auto text-[#0F56B3] text-xl"></i>
                    <span class="text-[#0F56B3] text-[12px] mx-auto font-bold mt-2">Activities</span>
                </div>
            </div>
        </a>

         <a href="report.php">
            <div class="w-[80px] h-[70px] bg-[#E1EDFC]  mt-7 mx-auto flex items-center justify-center hover:bg-blue-200">
                <div class="flex flex-col">
                    <i class="fa-solid fa-chart-simple mx-auto text-[#0F56B3] text-xl"></i>
                    <span class="text-[#0F56B3] text-[10px] text-center font-bold mt-1">Report
                        Management</span>
                </div>
            </div>
        </a>
        
        <?php if ($_SESSION['type_user'] !== 'Staff') : ?>
            <a href="user_m.php">
                <div class="w-[80px] h-[70px] bg-[#E1EDFC]  mt-7 mx-auto flex items-center justify-center hover:bg-blue-200">
                    <div class="flex flex-col">
                        <i class="fa-solid fa-circle-user mx-auto text-[#0F56B3] text-xl"></i>
                        <span class="text-[#0F56B3] text-[12px] text-center font-bold mt-1">User
                            Maintenance</span>
                    </div>
                </div>
            </a>

            <a href="setting.php">
                <div class="w-[80px] h-[70px] bg-[#E1EDFC]  mt-7 mx-auto flex items-center justify-center hover:bg-blue-200">
                    <div class="flex flex-col">
                        <i class="fa-solid fa-sliders mx-auto text-[#0F56B3] text-xl"></i>
                        <span class="text-[#0F56B3] text-[12px] text-center font-bold mt-2">Settings</span>
                    </div>
                </div>
            </a>
        <?php endif; ?>

       
    </div>
    <!-- <div class="hidden lg:block absolute bottom-0 translate-x-1/2 cursor-pointer">
        <img src="img/Chat square.png" alt="Chating">
    </div> -->
</div>