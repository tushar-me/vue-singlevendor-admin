import { createWebHistory, createRouter } from "vue-router";

import AddEmployee from "@/components/pages/employee/AddEmployee.vue";
import ManageEmployee from "@/components/pages/employee/ManageEmployee.vue";
import EditEmployee from '@/components/pages/employee/EditEmployee.vue';

import AddSupplier from '@/components/pages/supplier/Add.vue'
import EditSupplier from '@/components/pages/supplier/Edit.vue'
import ManageSupplier from '@/components/pages/supplier/Index.vue'

import ProductVariations from '@/components/pages/variations/Add.vue'
import MediVariation from '@/components/pages/variations/MediVariation.vue'

import AddExpense from '@/components/pages/expense/Add.vue'
import ManageExpense from '@/components/pages/expense/Index.vue'
import EditExpense from '@/components/pages/expense/Edit.vue'


import AddSalary from '@/components/pages/salary/Add.vue'
import ManageSalary from '@/components/pages/salary/Index.vue'
import MonthSalary from '@/components/pages/salary/MonthSalary.vue'


import FileUpload from '@/components/pages/uploadfile/UploadFile.vue';

import Dropzone from '@/components/pages/media/Dropzone.vue';

import Emp from '@/components/pages/emp/index.vue';

const routes =[
    //auth routes
    {
        path:'/login',
        name:'Login',
        meta:{layout:"auth"},
        component: ()=> import("@/views/Auth/Auth.vue")
    },
    {
        path:'/dashboard',
        name:'Dashboard',
        meta:{layout:"default"},
        component: ()=>import("@/views/Dashboard.vue")
    },
    {
        path:'/logout',
        name:'Logout',
        meta:{layout:"auth"},
        component: ()=> import("@/views/Auth/Logout.vue")
    },

    //employee routes
    {
        path:'/add-employee',
        name:'AddEmployee',
        meta:{layout:"default"},
        component: AddEmployee
    },
    {
        path:'/manage-employee',
        name:'ManageEmployee',
        meta:{layout:"default"},
        component: ManageEmployee
    },
    {
        path:'/edit-employee/:id',
        name:'EditEmployee',
        meta:{layout:"default"},
        component: EditEmployee
    },

    //supplier routes
    {
        path:'/add-supplier',
        name:'AddSupplier',
        meta:{layout:"default"},
        component: AddSupplier
    },
    {
        path:'/manage-supplier',
        name:'ManageSupplier',
        meta:{layout:"default"},
        component: ManageSupplier
    },
    {
        path:'/edit-supplier/:id',
        name:'EditSupplier',
        meta:{layout:"default"},
        component: EditSupplier
    },

    //category routes
    {
        path:'/add-category',
        name:'AddCategory',
        meta:{layout:"default"},
        component: ()=>import("@/views/category/Add.vue")
    },
    {
        path:'/manage-category',
        name:'ManageCategory',
        meta:{layout:"default"},
        component: ()=>import("@/views/category/Index.vue")
    },
    {
        path:'/edit-category/:id',
        name:'EditCategory',
        meta:{layout:"default"},
        component: ()=>import("@/views/category/Edit.vue")
    },

    //brand routes
    {
        path:'/add-brand',
        name:'AddBrand',
        meta:{layout:"default"},
        component:  ()=>import("@/views/brand/Add.vue")
    },
    {
        path:'/manage-brand',
        name:'ManageBrand',
        meta:{layout:"default"},
        component:  ()=>import("@/views/brand/Index.vue")
    },
    {
        path:'/edit-brand/:id',
        name:'EditBrand',
        meta:{layout:"default"},
        component:  ()=>import("@/views/brand/Edit.vue")
    },

    //variation routes
    {
        path:'/manage-product-variations',
        name:'ProductVariations',
        meta:{layout:"default"},
        component: ProductVariations
    },
    {
        path:'/medi-product-variations',
        name:'MediVariations',
        meta:{layout:"default"},
        component: MediVariation
    },

    //manage product
    {
        path:'/add-product',
        name:'AddProduct',
        meta:{layout:"default"},
        component: ()=> import("@/views/product/Add.vue")
    },
    {
        path:'/manage-product',
        name:'ManageProduct',
        meta:{layout:"default"},
        component: ()=> import("@/views/product/Index.vue")
    },
    {
        path:'/modify-product/:id',
        name:'ModifyProduct',
        meta:{layout:"default"},
        component: ()=> import("@/views/product/Modify.vue")
    },

    //expense routes
    {
        path:'/add-expense',
        name:'AddExpense',
        meta:{layout:"default"},
        component: AddExpense
    },
    {
        path:'/manage-expense',
        name:'ManageExpense',
        meta:{layout:"default"},
        component: ManageExpense
    },
    {
        path:'/edit-expense/:id',
        name:'EditExpense',
        meta:{layout:"default"},
        component: EditExpense
    },

    //salary routes
    {
        path:'/add-salary',
        name:'AddSalary',
        meta:{layout:"default"},
        component: AddSalary
    },
    {
        path:'/manage-salary',
        name:'ManageSalary',
        meta:{layout:"default"},
        component: ManageSalary
    },
    {
        path:'/month-salary/:id',
        name:'MonthSalary',
        meta:{layout:"default"},
        component: MonthSalary
    },


    //customer routes
    {
        path:'/add-customer',
        name:'AddCustomer',
        meta:{layout:"default"},
        component: ()=>  import("@/views/customer/Add.vue")
    },
    {
        path:'/manage-customer',
        name:'ManageCustomer',
        meta:{layout:"default"},
        component: ()=> import("@/views/customer/Index.vue")
    },
    {
        path:'/edit-customer/:id',
        name:'EditCustomer',
        meta:{layout:"default"},
        component: ()=> import("@/views/customer/Edit.vue")
    },


    //stoke route
    {
        path:'/stoke-manage',
        name: 'StokeManage',
        meta:{layout:"default"},
        component: ()=> import("@/views/product/Stoke.vue")
    },
    {
        path:'/manage-low-stoke',
        name: 'LowStoke',
        meta:{layout:"default"},
        component: ()=> import("@/views/product/LowStoke.vue")
    },

    //pos route
    {
        path:'/pos',
        name: 'Pos',
        meta:{layout:"default"},
        component: ()=>import("@/views/pos/Index.vue")
    },

    //order route
    {
        path:'/today-order',
        name:'TodayOrder',
        meta:{layout:"default"},
        component: import('@/views/order/TodayOrder.vue')
    },

    {
        path:'/manage-order',
        name:'ManageOrder',
        meta:{layout:"default"},
        component:  () => import('@/views/order/ManageOrder.vue')
    },
    {
        path:'/search-order',
        name:'SearchOrder',
        meta:{layout:"default"},
        component: import('@/views/order/SearchOrder.vue')
    },
    {
        path:'/search-order/:id',
        name:'ShowOrderDetails',
        meta:{layout:"default"},
        component: import('@/views/order/ShowOrder.vue')
    },
    //
    // // order areas
    // {
    //     path:'/areas',
    //     name:'OrderAreas',
    //     component: import('@/views/OrderArea/Index.vue')
    // },


    // areas module
    {
        path:'/areas',
        name:'Areas',
        meta:{layout:"default"},
        component: ()=>import("@/views/Areas/Index.vue")
    },




    //media route
    {
        path:'/dropzone',
        name:'DropZone',
        meta:{layout:"default"},
        component: Dropzone
    },
    {
        path:'/upload-multiple-file',
        name:'LiveUpload',
        meta:{layout:"default"},
        component: FileUpload
    },

    // product reviews module
    {
        path:'/product-reviews',
        name:'Reviews',
        meta:{layout:"default"},
        component: ()=>import("@/views/Review/Index.vue")
    },

    // product reviews module
    {
        path:'/product-questions',
        name:'Question',
        meta:{layout:"default"},
        component: ()=>import("@/views/Question/Index.vue")
    },


    // email tools
    {
        path:'/email-marketing',
        name:'Email',
        meta:{layout:"default"},
        component: ()=>import("@/views/Email/Panel.vue")
    },
    {
        path:'/manage-campaigns',
        name:'ManageCampaigns',
        meta:{layout:"default"},
        component: ()=>import("@/views/Email/ManageCampaign.vue")
    },

    // page management
    {
        path:'/pages',
        name:'Pages',
        meta:{layout:"default"},
        component: ()=>import("@/views/Pages/Index.vue")
    },
    {
        path:'/pages/create',
        name:'PageCreate',
        meta:{layout:"default"},
        component: ()=>import("@/views/Pages/Create.vue")
    },

    // settings routes
    {
        path:'/setting',
        name:'Setting',
        meta:{layout:"default"},
        component: ()=>import("@/views/Settings/Setting.vue")
    },
    // footer setting

    {
        path:'/setting/footer-setting',
        name:'FooterSetting',
        meta:{layout:"default"},
        component: ()=>import("@/views/Settings/FooterSetting.vue")
    },

    //emp routes
    {
        path:'/emp',
        name:'Emp',
        meta:{layout:"default"},
        component: Emp
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'not-found',
        component: () => import("@/views/Error.vue")
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(){
        document.getElementById('app').scrollIntoView({ behavior: 'smooth' });
    }
});




export default router;
