<template>
    <div>
        <h4>List:</h4>
        <ul class="expenses-list">
            <li v-for="expense in expensesList">
                {{ expense }}
            </li>
        </ul>
    </div>

</template>
<script>
    export default {
        data() {
            return {
                expensesList: []
            };
        },
        methods: {
            loadData: function () {
                const self = this;
                this.axios.get('/api/expenses').then(function (response) {
                    response.data.map(function (value) {
                        self.expensesList.push(value);
                    });
                })
            }
        },
        mounted() {
            this.loadData();
        }
    };
</script>