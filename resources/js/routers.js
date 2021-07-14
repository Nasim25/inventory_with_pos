let login = require('./components/auth/login.vue').default;
let logout = require('./components/auth/logout.vue').default;
let home = require('./components/home.vue').default;
// auth end
let storeEmployee = require('./components/employee/create.vue').default;
let employee = require('./components/employee/index.vue').default;
let editEmployee = require('./components/employee/edit.vue').default;
// end employee
let supplier = require('./components/supplier/index.vue').default;
let storeSupplier = require('./components/supplier/create.vue').default;
let editSupplier = require('./components/supplier/edit.vue').default;
// end supplier
let category = require('./components/category/index.vue').default;
let storeCategory = require('./components/category/create.vue').default;
let editCategory = require('./components/category/edit.vue').default;
// product
let product = require('./components/product/index.vue').default;
let productCreate = require('./components/product/create.vue').default;
// purchase
let purchaseCreate = require('./components/purchase/create.vue').default;
let purchaseList = require('./components/purchase/list.vue').default;
let purchaseDetails = require('./components/purchase/purchase_details.vue').default;
// pos
let pos = require('./components/pos/pos.vue').default;
// sales
let sales = require('./components/sales/index.vue').default;
// sales Details
let salesdetails = require('./components/sales/salesDetails.vue').default;
// customer list
let customercreate = require('./components/customer/create.vue').default;
let customerlist = require('./components/customer/index.vue').default;
// stocks
let stock = require('./components/stock/stock.vue').default;
//expense
let expenseCreate = require('./components/expense/create.vue').default;
let expense = require('./components/expense/index.vue').default;
// salary
let salray = require('./components/salary/allEmployee.vue').default;
let paySalray = require('./components/salary/paySalray.vue').default;

// Report
let productPurchaseReport = require('./components/report/productPurchaseReport.vue').default;
let dailySummary = require('./components/report/dailySummary.vue').default;
export const routes = [
    { path: '/', component: login, name:'/' },
    { path: '/logout', component: logout, name: 'logout'},
    { path: '/home', component: home, name:'home' },
    // auth end

    { path: '/store-employee', component: storeEmployee, name: 'store-employee'},
    { path: '/employee', component: employee, name: 'employee'},
    { path: '/edit-employee/:id', component: editEmployee, name: 'edit-employee'},
    // end employee
    { path: '/supplier', component: supplier, name: 'supplier'},
    { path: '/store-supplier', component: storeSupplier, name: 'store-supplier'},
    { path: '/edit-supplier/:id', component: editSupplier, name: 'edit-supplier'},
    // end supplier
    { path: '/category', component: category, name: 'category'},
    { path: '/store-category', component: storeCategory, name: 'store-category'},
    { path: '/edit-category', component: editCategory, name: 'edit-category'},
    // product start
    { path: '/product', component: product, name: 'product'},
    { path: '/product-create', component: productCreate, name: 'product-create'},
    // Purchase
    { path: '/purchase/create', component: purchaseCreate, name:'purchaseCreate'},
    { path: '/purchase/list', component: purchaseList, name:'purchaseList'},
    { path: '/purchase/details/:id', component: purchaseDetails, name:'purchaseDetails'},
    // POS start
      { path: '/pos', component: pos, name: 'pos'},
    // POS end
    // sales start
    { path: '/sales', component: sales, name: 'sales'},
    { path: '/salesdetails/:id', component: salesdetails, name: 'salesdetails'},
    // sales end
    
    // customer
    { path: '/store-customer', component: customercreate, name: 'customercreate'},
    { path: '/customer-list', component: customerlist, name: 'customerlist'},
    // customer
    { path: '/stock', component: stock, name: 'stock'},

    // expense

    { path: '/expense-create', component: expenseCreate, name: 'expense-create'},
    { path: '/expense', component: expense, name: 'expense'},

    // salary

    { path: '/given-salary', component: salray, name: 'given-salary'},
    { path: '/pay-salary/:id', component: paySalray, name: 'pay-salary'},


    // Report
    { path: '/product/purchase/report', component: productPurchaseReport, name: 'product/purchase/report'},
    { path: '/daily/summary', component: dailySummary, name: 'daily-summary'},
    

  ]