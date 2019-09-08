<template>

    <form>
        <input name="expenseName" type="text" v-model="form.expenseName">
        <input name="count" type="text" v-model="form.count">
        <input name="amount" type="text" v-model="form.amount">
        <datepicker v-model="form.date"></datepicker>
        <input type="time" v-model="form.time">
        <button @click.prevent="getFormValues()" type="submit">Add</button>
    </form>

</template>
<script>
    import Datepicker from 'vuejs-datepicker'

    export default {
        components: {
            Datepicker
        },
        data() {
            return {
                form: {
                    expenseName: null,
                    count: 1,
                    amount: null,
                    date: new Date(),
                    time: null
                }
            };
        },
        methods: {
            getFormValues() {
                this.axios.post('/form', this.form)
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                console.log(JSON.stringify(this.form));
            }
        }
    };
</script>