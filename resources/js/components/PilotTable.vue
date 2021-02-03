<template>

   
    <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                
                    <th> <a href="#" @click="sort('nome_piloto')">Nome Piloto</a></th>

                    <th> <a href="#" @click="sort('id')">Id </a></th>
                
                </tr>

            </thead>
            <tbody>
                <tr v-for="pilot in orderedPilots">
                
                    <th>{{ pilot.nome_piloto }}</th>

                    <th>{{ pilot.id }}</th>
                
                </tr>
            </tbody>
    </table>


</template>

<script>
    export default {
        props: [
            'pilots'
        ],

        data() {
            return {
                list: [],
                sortProperty: 'nome_piloto',
                sortDirection: 1,
            }
        },

        methods: {
            sort (property){
                this.sortProperty = property

                if(this.sortDirection == 1){
                    this.sortDirection = -1
                } else {
                    this.sortDirection = 1
                }

            },
        }, 
        
        mounted() {
            this.list = JSON.parse(this.pilots);
        },

        computed: {
            orderedPilots: function () {
                return _.orderBy(this.list, this.sortProperty)
            }
        }
    }
</script>
