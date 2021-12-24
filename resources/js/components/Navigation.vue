<template>
    <header :class="{ 'scrolled-nav': scrolledNav }">
        <nav>
            <div class="branding">Logo Here</div>
            <ul v-show="!mobile" class="navigation">
                <li>
                    <router-link class="link" to="/">Home</router-link>
                </li>
                <li>
                    <router-link to="/" class="link">Blogs</router-link>
                </li>
                <li>
                    <router-link to="/" class="link"
                        >Leave Feedback</router-link
                    >
                </li>
                <li>
                    <router-link to="/report-problem" class="link"
                        >Report a Problem</router-link
                    >
                </li>
                <li>
                    <router-link to="/contact-us" class="link"
                        >Contact Us</router-link
                    >
                </li>
                <li v-if="!isLoggedIn">
                    <router-link to="/login" class="link">Login</router-link>
                </li>
                <li v-if="!isLoggedIn">
                    <router-link to="/register" class="link"
                        >Register</router-link
                    >
                </li>
                <!-- <li v-if="!isLoggedIn">
                    <router-link to="/myAccount" class="link"
                        >My account</router-link
                    >
                </li> -->
                <li>
                    <!-- <router-link to="/" class="link" @click="Logout"
                        >Logout</router-link
                    > -->
                    <button class="btn btn-danger" @click="Logout()">
                        Logout
                    </button>
                </li>
                <!-- <li>
                    <router-link to="/" class="link">Logout</router-link>
                </li> -->
            </ul>
            <div class="icon">
                <i
                    @click="toggleMobileNav"
                    v-show="mobile"
                    :class="{ 'icon-active': mobileNav }"
                    >=</i
                >
            </div>
            <transition name="mobile-nav">
                <ul v-show="mobileNav" class="dropdown-nav">
                    <li><router-link class="link" to="/">Home</router-link></li>
                    <li>
                        <router-link to="/" class="link">Blogs</router-link>
                    </li>
                    <li>
                        <router-link to="/" class="link"
                            >Leave Feedback</router-link
                        >
                    </li>
                    <li>
                        <router-link to="/report-problem" class="link"
                            >Report a Problem</router-link
                        >
                    </li>
                    <li>
                        <router-link to="/" class="link"
                            >Contact us</router-link
                        >
                    </li>
                    <li v-if="!isLoggedIn">
                        <router-link to="/login" class="link"
                            >Login</router-link
                        >
                    </li>
                    <li v-if="!isLoggedIn">
                        <router-link to="/register" class="link"
                            >Register</router-link
                        >
                    </li>
                    <!-- <li v-if="!isLoggedIn">
                    <router-link to="/myAccount" class="link"
                        >My account</router-link
                    >
                </li> -->
                    <li>
                        <!-- <router-link to="/" class="link" @click="Logout"
                        >Logout</router-link
                    > -->
                        <button class="btn btn-danger" @click="Logout()">
                            Logout
                        </button>
                    </li>
                    <!-- <li>
                        <router-link :to="{ name: 'Register' }" class="link"
                            >Logout</router-link
                        >
                    </li> -->
                </ul>
            </transition>
        </nav>
    </header>
</template>

<script>
import axios from "axios";
export default {
    name: "navigation",
    data() {
        return {
            scrolledNav: null,
            mobile: null,
            mobileNav: null,
            windowWidth: null,
            isLoggedIn: false,
        };
    },
    created() {
        window.addEventListener("resize", this.checkScreen);
        this.checkScreen();
    },
    mounted() {
        window.addEventListener("scroll", this.updateScroll);
        this.checkLoginStatus();
        console.log(this.$route);
        console.log(localStorage);
    },
    methods: {
        toggleMobileNav() {
            this.mobileNav = !this.mobileNav;
        },

        updateScroll() {
            const scrollPosition = window.scrollY;
            if (scrollPosition > 50) {
                this.scrolledNav = true;
                return;
            }
            this.scrolledNav = false;
        },

        checkScreen() {
            this.windowWidth = window.innerWidth;
            if (this.windowWidth <= 750) {
                this.mobile = true;
                return;
            }
            this.mobile = false;
            this.mobileNav = false;
            return;
        },
        checkLoginStatus() {
            let storageToken = localStorage.getItem("token");
            axios
                .get("/api/user", {
                    headers: {
                        Authorization: "Bearer " + storageToken,
                    },
                })
                .then((response) => {
                    this.currentUser = response.data;
                    console.log("LOGGED IN");
                    this.isLoggedIn = true;
                    console.log(this.currentUser.id);
                })
                .catch((errors) => {
                    console.log(errors);
                    this.isLoggedIn = false;
                    currentUser = null;
                });
            // .finally(() => {
            //     this.loading = false;
            // });
            // this.loading = false
        },

        Logout() {
            axios
                .post(
                    "/api/logout",
                    {},
                    {
                        headers: {
                            Authentication: "Bearer " + this.token,
                        },
                    }
                )
                .then((response) => {
                    // localStorage.removeItem("token");
                    this.isLoggedIn = false;
                    console.log(localStorage);
                    console.log(this.isLoggedIn);

                    if (this.$route.path != "/") {
                        this.$router.push("/");
                    }
                })
                .catch((errors) => {
                    console.log(errors);
                })
                .finally(() => {
                    localStorage.removeItem("token");
                });
        },
    },
};
</script>

<style lang="scss" scoped>
header {
    background-color: rgba(0, 0, 0, 0.8);
    z-index: 99;
    width: 100%;
    position: fixed;
    margin-bottom: 80px;
    transition: 0.5s ease all;
    color: #fff;

    nav {
        position: relative;
        display: flex;
        flex-direction: row;
        // padding: 10px 0;
        padding-top: 10px;
        transition: 0.5s ease all;
        width: 100%;
        margin: 0 auto;

        @media (min-width: 1140px) {
            max-width: 1140px;
        }

        ul,
        .link {
            font-weight: 500;
            color: #fff;
            list-style: none;
            text-decoration: none;
        }

        li {
            text-transform: uppercase;
            // padding: 16px;
            padding-top: 5px;
            margin-left: 16px;
        }

        .link {
            font-size: 14px;
            transition: 0.5s ease all;
            padding-bottom: 4px;
            border-bottom: 1px solid transparent;

            &:hover {
                color: #eb3007;
                border-color: #eb3007;
            }
        }
        .branding {
            display: flex;
            align-items: center;
        }

        .navigation {
            display: flex;
            align-items: center;
            flex: 1;
            justify-content: flex-end;
        }

        .icon {
            display: flex;
            align-items: center;
            position: absolute;
            top: 0;
            right: 24px;
            height: 100%;
            font-weight: 700;

            i {
                cursor: pointer;
                font-size: 24px;
                transition: 0.8s ease all;
            }
        }

        .icon-active {
            transform: rotate(360deg);
        }

        .dropdown-nav {
            display: flex;
            flex-direction: column;
            position: fixed;
            width: 100%;
            max-width: 250px;
            height: 100%;
            background-color: #fff;
            top: 0;
            left: 0;

            li {
                margin-left: 0;
                .link {
                    color: #000;
                }
            }
        }

        .mobile-nav-enter-active,
        .mobile-nav-leave-active {
            transition: 1s ease all;
        }

        .mobile-nav-enter-from,
        .mobile-nav-leave-to {
            transform: translateX(-250px);
        }

        .mobile-nav-enter-to {
            transform: translateX(0px);
        }
    }
}

.scrolled-nav {
    background-color: #000;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
        0 2px 4px -1px rgba(0, 0, 0, 0.06);

    nav {
        padding: 8px 0;

        // .branding {
        //     // img {
        //     //     width: 40px;
        //     //     box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
        //     //         0 2px 4px -1px rgba(0, 0, 0, 0.06);
        //     // }
        // }
    }
}
</style>
