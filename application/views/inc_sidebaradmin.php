    
    <aside class="sidebar sidebar-default sidebar-white sidebar-base sidebar-dark sidebar-mini sidebar-hover sidebar-boxed navs-rounded-all ">
        <div class="sidebar-header d-flex align-items-center justify-content-start">
            <a href="" class="navbar-brand">
                
                <!--Logo start
                <div class="logo-main">
                    <div class="logo-normal">
                        <svg class=" icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                            <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                            <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                            <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                        </svg>
                    </div>
                    <div class="logo-mini">
                        <svg class=" icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                            <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                            <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                            <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                        </svg>
                    </div>
                </div> -->
                <img src="<?php echo base_url(); ?>/assets/images/iconwhite.png" style="width: 35%; height: auto;">

                <!--logo End-->
                
                
                
                
                <h4 class="logo-title">SolEnergy</h4>
            </a>
            <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                <i class="icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </i>
            </div>
        </div>
        <div class="sidebar-body sidebar-default sidebar-white sidebar-base sidebar-dark sidebar-mini sidebar-hover sidebar-boxed navs-rounded-all" style="max-height: 80vh; overflow-y: auto;">
            <div class="scroll-content">
                <div class="sidebar-list">
                    <!-- Sidebar Menu Start --> 
                    <ul class="navbar-nav iq-main-menu" id="sidebar-menu">

                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="<?php echo base_url('index.php/monitoreo/adm_index'); ?>">
                                <i class="icon">
                                    <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.14373 20.7821V17.7152C9.14372 16.9381 9.77567 16.3067 10.5584 16.3018H13.4326C14.2189 16.3018 14.8563 16.9346 14.8563 17.7152V20.7732C14.8562 21.4473 15.404 21.9951 16.0829 22H18.0438C18.9596 22.0023 19.8388 21.6428 20.4872 21.0007C21.1356 20.3586 21.5 19.4868 21.5 18.5775V9.86585C21.5 9.13139 21.1721 8.43471 20.6046 7.9635L13.943 2.67427C12.7785 1.74912 11.1154 1.77901 9.98539 2.74538L3.46701 7.9635C2.87274 8.42082 2.51755 9.11956 2.5 9.86585V18.5686C2.5 20.4637 4.04738 22 5.95617 22H7.87229C8.19917 22.0023 8.51349 21.8751 8.74547 21.6464C8.97746 21.4178 9.10793 21.1067 9.10792 20.7821H9.14373Z" fill="currentColor"></path>
                                    </svg>
                                </i>
                                <span class="item-name">Inicio</span>
                            </a>
                        </li>                         

                        <li class="nav-item static-item">
                            <a class="nav-link static-item disabled" href="#" tabindex="-1">
                                <span class="default-icon">Usuarios</span>
                                <span class="mini-icon">-</span>
                            </a>
                        </li>
                                 
                        <!-- Usuarios Agregar Lista -->
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="<?php echo base_url('index.php/monitoreo/registrarUsuario'); ?>">
                                <i class="icon">
                                    <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" d="M21.101 9.58786H19.8979V8.41162C19.8979 7.90945 19.4952 7.5 18.999 7.5C18.5038 7.5 18.1 7.90945 18.1 8.41162V9.58786H16.899C16.4027 9.58786 16 9.99731 16 10.4995C16 11.0016 16.4027 11.4111 16.899 11.4111H18.1V12.5884C18.1 13.0906 18.5038 13.5 18.999 13.5C19.4952 13.5 19.8979 13.0906 19.8979 12.5884V11.4111H21.101C21.5962 11.4111 22 11.0016 22 10.4995C22 9.99731 21.5962 9.58786 21.101 9.58786Z" fill="currentColor"></path>
                                        <path d="M9.5 15.0156C5.45422 15.0156 2 15.6625 2 18.2467C2 20.83 5.4332 21.5001 9.5 21.5001C13.5448 21.5001 17 20.8533 17 18.269C17 15.6848 13.5668 15.0156 9.5 15.0156Z" fill="currentColor"></path>
                                        <path opacity="0.4" d="M9.50023 12.5542C12.2548 12.5542 14.4629 10.3177 14.4629 7.52761C14.4629 4.73754 12.2548 2.5 9.50023 2.5C6.74566 2.5 4.5376 4.73754 4.5376 7.52761C4.5376 10.3177 6.74566 12.5542 9.50023 12.5542Z" fill="currentColor"></path>
                                    </svg>
                                </i>
                                <span class="item-name">Agregar Usuario</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="<?php echo base_url(); ?>index.php/monitoreo/listaUsuario">
                                <i class="icon">
                                    <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.9488 14.54C8.49884 14.54 5.58789 15.1038 5.58789 17.2795C5.58789 19.4562 8.51765 20.0001 11.9488 20.0001C15.3988 20.0001 18.3098 19.4364 18.3098 17.2606C18.3098 15.084 15.38 14.54 11.9488 14.54Z" fill="currentColor"></path>
                                        <path opacity="0.4" d="M11.949 12.467C14.2851 12.467 16.1583 10.5831 16.1583 8.23351C16.1583 5.88306 14.2851 4 11.949 4C9.61293 4 7.73975 5.88306 7.73975 8.23351C7.73975 10.5831 9.61293 12.467 11.949 12.467Z" fill="currentColor"></path>
                                        <path opacity="0.4" d="M21.0881 9.21923C21.6925 6.84176 19.9205 4.70654 17.664 4.70654C17.4187 4.70654 17.1841 4.73356 16.9549 4.77949C16.9244 4.78669 16.8904 4.802 16.8725 4.82902C16.8519 4.86324 16.8671 4.90917 16.8895 4.93889C17.5673 5.89528 17.9568 7.0597 17.9568 8.30967C17.9568 9.50741 17.5996 10.6241 16.9728 11.5508C16.9083 11.6462 16.9656 11.775 17.0793 11.7948C17.2369 11.8227 17.3981 11.8371 17.5629 11.8416C19.2059 11.8849 20.6807 10.8213 21.0881 9.21923Z" fill="currentColor"></path>
                                        <path d="M22.8094 14.817C22.5086 14.1722 21.7824 13.73 20.6783 13.513C20.1572 13.3851 18.747 13.205 17.4352 13.2293C17.4155 13.232 17.4048 13.2455 17.403 13.2545C17.4003 13.2671 17.4057 13.2887 17.4316 13.3022C18.0378 13.6039 20.3811 14.916 20.0865 17.6834C20.074 17.8032 20.1698 17.9068 20.2888 17.8888C20.8655 17.8059 22.3492 17.4853 22.8094 16.4866C23.0637 15.9589 23.0637 15.3456 22.8094 14.817Z" fill="currentColor"></path>
                                        <path opacity="0.4" d="M7.04459 4.77973C6.81626 4.7329 6.58077 4.70679 6.33543 4.70679C4.07901 4.70679 2.30701 6.84201 2.9123 9.21947C3.31882 10.8216 4.79355 11.8851 6.43661 11.8419C6.60136 11.8374 6.76343 11.8221 6.92013 11.7951C7.03384 11.7753 7.09115 11.6465 7.02668 11.551C6.3999 10.6234 6.04263 9.50765 6.04263 8.30991C6.04263 7.05904 6.43303 5.89462 7.11085 4.93913C7.13234 4.90941 7.14845 4.86348 7.12696 4.82926C7.10906 4.80135 7.07593 4.78694 7.04459 4.77973Z" fill="currentColor"></path>
                                        <path d="M3.32156 13.5127C2.21752 13.7297 1.49225 14.1719 1.19139 14.8167C0.936203 15.3453 0.936203 15.9586 1.19139 16.4872C1.65163 17.4851 3.13531 17.8066 3.71195 17.8885C3.83104 17.9065 3.92595 17.8038 3.91342 17.6832C3.61883 14.9167 5.9621 13.6046 6.56918 13.3029C6.59425 13.2885 6.59962 13.2677 6.59694 13.2542C6.59515 13.2452 6.5853 13.2317 6.5656 13.2299C5.25294 13.2047 3.84358 13.3848 3.32156 13.5127Z" fill="currentColor"></path>
                                    </svg>
                                </i>
                                <span class="item-name">Lista de Usuarios</span>
                            </a>
                        </li> 

                        <li class="nav-item static-item">
                            <a class="nav-link static-item disabled" href="#" tabindex="-1">
                                <span class="default-icon">Dispositivos</span>
                                <span class="mini-icon">-</span>
                            </a>
                        </li>
                                 
                        <!-- Agregar Dispositivo Lista -->
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="<?php echo base_url('index.php/monitoreo/registrarDispositivo'); ?>">
                                <i class="icon">
                                    <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" d="M18.8088 9.021C18.3573 9.021 17.7592 9.011 17.0146 9.011C15.1987 9.011 13.7055 7.508 13.7055 5.675V2.459C13.7055 2.206 13.5026 2 13.253 2H7.96363C5.49517 2 3.5 4.026 3.5 6.509V17.284C3.5 19.889 5.59022 22 8.16958 22H16.0453C18.5058 22 20.5 19.987 20.5 17.502V9.471C20.5 9.217 20.298 9.012 20.0465 9.013C19.6247 9.016 19.1168 9.021 18.8088 9.021Z" fill="currentColor"></path>
                                        <path opacity="0.4" d="M16.0842 2.56737C15.7852 2.25637 15.2632 2.47037 15.2632 2.90137V5.53837C15.2632 6.64437 16.1742 7.55437 17.2792 7.55437C17.9772 7.56237 18.9452 7.56437 19.7672 7.56237C20.1882 7.56137 20.4022 7.05837 20.1102 6.75437C19.0552 5.65737 17.1662 3.69137 16.0842 2.56737Z" fill="currentColor"></path>
                                        <path d="M14.3672 12.2364H12.6392V10.5094C12.6392 10.0984 12.3062 9.7644 11.8952 9.7644C11.4842 9.7644 11.1502 10.0984 11.1502 10.5094V12.2364H9.4232C9.0122 12.2364 8.6792 12.5704 8.6792 12.9814C8.6792 13.3924 9.0122 13.7264 9.4232 13.7264H11.1502V15.4524C11.1502 15.8634 11.4842 16.1974 11.8952 16.1974C12.3062 16.1974 12.6392 15.8634 12.6392 15.4524V13.7264H14.3672C14.7782 13.7264 15.1122 13.3924 15.1122 12.9814C15.1122 12.5704 14.7782 12.2364 14.3672 12.2364Z" fill="currentColor"></path>
                                    </svg>
                                </i>
                                <span class="item-name">Registrar Dispositivo</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="<?php echo base_url('index.php/monitoreo/listaDispositivo'); ?>">
                                <i class="icon">
                                    <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" d="M18.8088 9.021C18.3573 9.021 17.7592 9.011 17.0146 9.011C15.1987 9.011 13.7055 7.508 13.7055 5.675V2.459C13.7055 2.206 13.5036 2 13.253 2H7.96363C5.49517 2 3.5 4.026 3.5 6.509V17.284C3.5 19.889 5.59022 22 8.16958 22H16.0463C18.5058 22 20.5 19.987 20.5 17.502V9.471C20.5 9.217 20.299 9.012 20.0475 9.013C19.6247 9.016 19.1177 9.021 18.8088 9.021Z" fill="currentColor"></path>
                                        <path opacity="0.4" d="M16.0842 2.56737C15.7852 2.25637 15.2632 2.47037 15.2632 2.90137V5.53837C15.2632 6.64437 16.1742 7.55437 17.2802 7.55437C17.9772 7.56237 18.9452 7.56437 19.7672 7.56237C20.1882 7.56137 20.4022 7.05837 20.1102 6.75437C19.0552 5.65737 17.1662 3.69137 16.0842 2.56737Z" fill="currentColor"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.97398 11.3877H12.359C12.77 11.3877 13.104 11.0547 13.104 10.6437C13.104 10.2327 12.77 9.89868 12.359 9.89868H8.97398C8.56298 9.89868 8.22998 10.2327 8.22998 10.6437C8.22998 11.0547 8.56298 11.3877 8.97398 11.3877ZM8.97408 16.3819H14.4181C14.8291 16.3819 15.1631 16.0489 15.1631 15.6379C15.1631 15.2269 14.8291 14.8929 14.4181 14.8929H8.97408C8.56308 14.8929 8.23008 15.2269 8.23008 15.6379C8.23008 16.0489 8.56308 16.3819 8.97408 16.3819Z" fill="currentColor"></path>
                                    </svg>
                                </i>
                                <span class="item-name">Lista de Dispositivos</span>
                            </a>
                        </li>
                        
                        <li class="nav-item static-item">
                            <a class="nav-link static-item disabled" href="#" tabindex="-1">
                                <span class="default-icon">Recibo</span>
                                <span class="mini-icon">-</span>
                            </a>
                        </li>
                                 
                        <!-- Agregar Recibo Lista -->
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="<?php echo base_url('index.php/monitoreo/aviso'); ?>">
                                <i class="icon">
                                    <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" d="M16.6643 21.9897H7.33488C5.88835 22.0796 4.46781 21.5781 3.3989 20.6011C2.4219 19.5312 1.92041 18.1107 2.01032 16.6652V7.33482C1.92041 5.88932 2.4209 4.46878 3.3979 3.39889C4.46781 2.42189 5.88835 1.92041 7.33488 2.01032H16.6643C18.1089 1.92041 19.5284 2.4209 20.5973 3.39789C21.5733 4.46878 22.0758 5.88832 21.9899 7.33482V16.6652C22.0788 18.1107 21.5783 19.5312 20.6013 20.6011C19.5314 21.5781 18.1109 22.0796 16.6643 21.9897Z" fill="currentColor"></path>
                                        <path d="M17.0545 10.3976L10.5018 16.9829C10.161 17.3146 9.7131 17.5 9.24574 17.5H6.95762C6.83105 17.5 6.71421 17.4512 6.62658 17.3634C6.53895 17.2756 6.5 17.1585 6.5 17.0317L6.55842 14.7195C6.56816 14.261 6.75315 13.8317 7.07446 13.5098L11.7189 8.8561C11.7967 8.77805 11.9331 8.77805 12.011 8.8561L13.6399 10.4785C13.747 10.5849 13.9028 10.6541 14.0683 10.6541C14.4286 10.6541 14.7109 10.3615 14.7109 10.0102C14.7109 9.83463 14.6428 9.67854 14.5357 9.56146C14.5065 9.52244 12.9554 7.97805 12.9554 7.97805C12.858 7.88049 12.858 7.71463 12.9554 7.61707L13.6078 6.95366C14.2114 6.34878 15.1851 6.34878 15.7888 6.95366L17.0545 8.22195C17.6485 8.81707 17.6485 9.79268 17.0545 10.3976Z" fill="currentColor"></path>
                                    </svg>                            
                                </i>
                                <span class="item-name">Nuevo Aviso</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="<?php echo base_url('index.php/factura/estadoFactura'); ?>">
                                <i class="icon">
                                    <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" d="M16.191 2H7.81C4.77 2 3 3.78 3 6.83V17.16C3 20.26 4.77 22 7.81 22H16.191C19.28 22 21 20.26 21 17.16V6.83C21 3.78 19.28 2 16.191 2Z" fill="currentColor"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.07996 6.6499V6.6599C7.64896 6.6599 7.29996 7.0099 7.29996 7.4399C7.29996 7.8699 7.64896 8.2199 8.07996 8.2199H11.069C11.5 8.2199 11.85 7.8699 11.85 7.4289C11.85 6.9999 11.5 6.6499 11.069 6.6499H8.07996ZM15.92 12.7399H8.07996C7.64896 12.7399 7.29996 12.3899 7.29996 11.9599C7.29996 11.5299 7.64896 11.1789 8.07996 11.1789H15.92C16.35 11.1789 16.7 11.5299 16.7 11.9599C16.7 12.3899 16.35 12.7399 15.92 12.7399ZM15.92 17.3099H8.07996C7.77996 17.3499 7.48996 17.1999 7.32996 16.9499C7.16996 16.6899 7.16996 16.3599 7.32996 16.1099C7.48996 15.8499 7.77996 15.7099 8.07996 15.7399H15.92C16.319 15.7799 16.62 16.1199 16.62 16.5299C16.62 16.9289 16.319 17.2699 15.92 17.3099Z" fill="currentColor"></path>
                                    </svg>
                                </i>
                                <span class="item-name">Lista de Avisos</span>
                            </a>
                        </li>

                        <li class="nav-item static-item">
                            <a class="nav-link static-item disabled" href="#" tabindex="-1">
                                <span class="default-icon">Pagos</span>
                                <span class="mini-icon">-</span>
                            </a>
                        </li>

                        <!-- Agregar Recibo Lista -->
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="<?php echo base_url('index.php/factura/pago'); ?>">
                                <i class="icon">
                                    <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" d="M16.6643 21.9897H7.33488C5.88835 22.0796 4.46781 21.5781 3.3989 20.6011C2.4219 19.5312 1.92041 18.1107 2.01032 16.6652V7.33482C1.92041 5.88932 2.4209 4.46878 3.3979 3.39889C4.46781 2.42189 5.88835 1.92041 7.33488 2.01032H16.6643C18.1089 1.92041 19.5284 2.4209 20.5973 3.39789C21.5733 4.46878 22.0758 5.88832 21.9899 7.33482V16.6652C22.0788 18.1107 21.5783 19.5312 20.6013 20.6011C19.5314 21.5781 18.1109 22.0796 16.6643 21.9897Z" fill="currentColor"></path>
                                        <path d="M17.0545 10.3976L10.5018 16.9829C10.161 17.3146 9.7131 17.5 9.24574 17.5H6.95762C6.83105 17.5 6.71421 17.4512 6.62658 17.3634C6.53895 17.2756 6.5 17.1585 6.5 17.0317L6.55842 14.7195C6.56816 14.261 6.75315 13.8317 7.07446 13.5098L11.7189 8.8561C11.7967 8.77805 11.9331 8.77805 12.011 8.8561L13.6399 10.4785C13.747 10.5849 13.9028 10.6541 14.0683 10.6541C14.4286 10.6541 14.7109 10.3615 14.7109 10.0102C14.7109 9.83463 14.6428 9.67854 14.5357 9.56146C14.5065 9.52244 12.9554 7.97805 12.9554 7.97805C12.858 7.88049 12.858 7.71463 12.9554 7.61707L13.6078 6.95366C14.2114 6.34878 15.1851 6.34878 15.7888 6.95366L17.0545 8.22195C17.6485 8.81707 17.6485 9.79268 17.0545 10.3976Z" fill="currentColor"></path>
                                    </svg>                            
                                </i>
                                <span class="item-name">Nuevo Recibo</span>
                            </a>
                        </li>

                        <li class="nav-item static-item">
                            <a class="nav-link static-item disabled" href="#" tabindex="-1">
                                <span class="default-icon">Perfil</span>
                                <span class="mini-icon">-</span>
                            </a>
                        </li>
                                 
                        <!-- Agregar Dispositivo Lista -->
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="<?php echo base_url(); ?>index.php/monitoreo/perfilAdm">
                                <i class="icon">
                                    <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.0122 14.8299C10.4077 14.8299 9.10986 13.5799 9.10986 12.0099C9.10986 10.4399 10.4077 9.17993 12.0122 9.17993C13.6167 9.17993 14.8839 10.4399 14.8839 12.0099C14.8839 13.5799 13.6167 14.8299 12.0122 14.8299Z" fill="currentColor"></path>
                                        <path opacity="0.4" d="M21.2301 14.37C21.036 14.07 20.76 13.77 20.4023 13.58C20.1162 13.44 19.9322 13.21 19.7687 12.94C19.2475 12.08 19.5541 10.95 20.4228 10.44C21.4447 9.87 21.7718 8.6 21.179 7.61L20.4943 6.43C19.9118 5.44 18.6344 5.09 17.6226 5.67C16.7233 6.15 15.5685 5.83 15.0473 4.98C14.8838 4.7 14.7918 4.4 14.8122 4.1C14.8429 3.71 14.7203 3.34 14.5363 3.04C14.1582 2.42 13.4735 2 12.7172 2H11.2763C10.5302 2.02 9.84553 2.42 9.4674 3.04C9.27323 3.34 9.16081 3.71 9.18125 4.1C9.20169 4.4 9.10972 4.7 8.9462 4.98C8.425 5.83 7.27019 6.15 6.38109 5.67C5.35913 5.09 4.09191 5.44 3.49917 6.43L2.81446 7.61C2.23194 8.6 2.55897 9.87 3.57071 10.44C4.43937 10.95 4.74596 12.08 4.23498 12.94C4.06125 13.21 3.87729 13.44 3.59115 13.58C3.24368 13.77 2.93709 14.07 2.77358 14.37C2.39546 14.99 2.4159 15.77 2.79402 16.42L3.49917 17.62C3.87729 18.26 4.58245 18.66 5.31825 18.66C5.66572 18.66 6.0745 18.56 6.40153 18.36C6.65702 18.19 6.96361 18.13 7.30085 18.13C8.31259 18.13 9.16081 18.96 9.18125 19.95C9.18125 21.1 10.1215 22 11.3069 22H12.6968C13.872 22 14.8122 21.1 14.8122 19.95C14.8429 18.96 15.6911 18.13 16.7029 18.13C17.0299 18.13 17.3365 18.19 17.6022 18.36C17.9292 18.56 18.3278 18.66 18.6855 18.66C19.411 18.66 20.1162 18.26 20.4943 17.62L21.2097 16.42C21.5776 15.75 21.6083 14.99 21.2301 14.37Z" fill="currentColor"></path>
                                    </svg>
                                </i>
                                <span class="item-name">Editar Perfil</span>
                            </a>
                        </li>

                        <li>
                            <br>
                            <br>
                        </li>
                        <!--
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="<?php echo base_url('index.php/monitoreo/passwordAdm'); ?>">
                                <i class="icon">
                                    <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" d="M16.3345 1.99976H7.66549C4.27649 1.99976 2.00049 4.37776 2.00049 7.91676V16.0838C2.00049 19.6218 4.27649 21.9998 7.66549 21.9998H16.3335C19.7225 21.9998 22.0005 19.6218 22.0005 16.0838V7.91676C22.0005 4.37776 19.7235 1.99976 16.3345 1.99976Z" fill="currentColor"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.3144 11.2484H17.0144C17.4244 11.2484 17.7644 11.5884 17.7644 11.9984V13.8484C17.7644 14.2684 17.4244 14.5984 17.0144 14.5984C16.5944 14.5984 16.2644 14.2684 16.2644 13.8484V12.7484H14.9344V13.8484C14.9344 14.2684 14.5944 14.5984 14.1844 14.5984C13.7644 14.5984 13.4344 14.2684 13.4344 13.8484V12.7484H11.3144C10.9944 13.8184 10.0144 14.5984 8.84437 14.5984C7.40437 14.5984 6.23438 13.4384 6.23438 11.9984C6.23438 10.5684 7.40437 9.39844 8.84437 9.39844C10.0144 9.39844 10.9944 10.1784 11.3144 11.2484ZM7.73438 11.9984C7.73438 12.6084 8.23438 13.0984 8.84438 13.0984C9.44438 13.0984 9.94438 12.6084 9.94438 11.9984C9.94438 11.3884 9.44438 10.8984 8.84438 10.8984C8.23438 10.8984 7.73438 11.3884 7.73438 11.9984Z" fill="currentColor"></path>
                                    </svg>
                                </i>
                                <span class="item-name">Cambiar Contraseña</span>
                            </a>
                        </li>
                        -->
                        
                    </ul>
                    <!-- Sidebar Menu End -->        
                </div>
            </div>
            
            <!-- 
            <div class="scrollbar-track scrollbar-track-x" style="display: none;"><div class="scrollbar-thumb scrollbar-thumb-x" style="width: 259px; transform: translate3d(0px, 0px, 0px);"></div></div>
            <div class="scrollbar-track scrollbar-track-y show" style="display: block;"><div class="scrollbar-thumb scrollbar-thumb-y" style="height: 474.849px; transform: translate3d(0px, 0px, 0px);"></div></div>
            -->
        </div>
        <div class="sidebar-footer"></div>
    </aside>