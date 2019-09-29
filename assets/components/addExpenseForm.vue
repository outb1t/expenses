<template>

    <form>
        <input name="item" type="text" v-model="form.item">
        <input name="count" type="text" v-model="form.count">
        <input name="amount" type="text" v-model="form.amount">
        <datepicker v-model="form.date"></datepicker>
        <input type="time" v-model="form.time">
        <button @click.prevent="submitForm()" type="submit">Add</button>
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
                    item: null,
                    count: 1,
                    amount: null,
                    date: new Date(),
                    time: null
                }
            };
        },
        methods: {
            submitForm() {
                this.axios.post('/api/expenses', this.form)
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