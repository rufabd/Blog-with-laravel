import Home from "./pages/Home.vue";
import Register from "./pages/Register.vue";
import Login from "./pages/Login.vue";
import UserAccount from "./pages/UserAccount.vue";
import Categories from "./pages/Admin/Categories.vue";
import Users from "./pages/Admin/Users.vue";
import Dashboard from "./pages/Admin/Dashboard.vue";
import CreateCategory from "./pages/Admin/CreateCategory.vue";
import CategoryEdit from "./pages/Admin/EditCategory";
import Blogs from "./pages/Admin/Blogs";
import CreateBlog from "./pages/Admin/CreateBlog";
import EditBlog from "./pages/Admin/EditBlog.vue";
import ShowSpecificBlog from "./pages/Admin/ShowSpecificBlog.vue";
import ReportProblem from "./pages/ReportProblem.vue";
import ContactUs from "./pages/ContactUs.vue";
import editorDashboard from "./pages/blogWriter/editorDashboard.vue";
import Problems from "./pages/Admin/Problems.vue";

export const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/register",
        name: "Register",
        component: Register,
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
    },
    {
        path: "/myAccount",
        name: "MyAccount",
        component: UserAccount,
    },
    {
        path: "/categories-list",
        name: "Categories",
        component: Categories,
    },
    {
        path: "/users",
        name: "Users",
        component: Users,
    },
    {
        path: "/dashboard",
        name: "Dashboard",
        component: Dashboard,
    },
    {
        path: "/categories/create",
        name: "CreateCategory",
        component: CreateCategory,
    },
    {
        path: "/category/edit/:id",
        component: CategoryEdit,
        name: "CategoryEdit",
    },
    {
        path: "/blogs-list",
        name: "Blogs",
        component: Blogs,
    },
    {
        path: "/blogs/create",
        name: "CreateBlog",
        component: CreateBlog,
    },
    {
        path: "/blog/edit/:id",
        component: EditBlog,
        name: "EditBlog",
    },
    {
        path: "/blogPost/:id",
        component: ShowSpecificBlog,
        name: "ShowSpecificBlog",
    },
    {
        path: "/report-problem",
        component: ReportProblem,
        name: "ReportProblem",
    },
    {
        path: "/contact-us",
        component: ContactUs,
        name: "ContactUs",
    },
    {
        path: "/editorDashboard",
        component: editorDashboard,
        name: "editorDashboard",
    },
    {
        path: "/problemslist",
        component: Problems,
        name: "Problems",
    },
];
