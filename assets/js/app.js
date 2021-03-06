import '../css/app.css';

import Vue from 'vue';
import addExpenseForm from '../components/addExpenseForm';
import expensesList from '../components/expensesList';
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios);

new Vue({
    el: '#app',
    components: {
        addExpenseForm, expensesList
    }
});

