<template>
    <div>
        <v-file-input
            accept="csv/*"
            label="File input"
            v-model="file"
            v-if="!working"
        ></v-file-input>
        <v-progress-linear
            v-if="working"
            indeterminate
            color="cyan"
            purple
            rounded
        ></v-progress-linear>
        <v-btn
            elevation="2"
            dark
            x-large
            color="cyan text-uppercase"
            block
            @click="send"
            v-if="!working && readyArr.length !== 0"
        >
            import
        </v-btn>
        <br v-if="!working">
        <v-btn
            elevation="2"
            dark
            x-large
            color="red text-uppercase"
            block
            v-if="!working && isDataExistInDB"
            @click="clean"
        >
            clean
        </v-btn>
        <v-snackbar
            :timeout="3000"
            fixed
            bottom
            right
            tile
            v-for="item in response"
            :value="item.message"
            :color="item.status  ?? 'red accent-2'"
            :key="item.id"
        >
            {{ item.message }}
        </v-snackbar>
    </div>
</template>
<script>
export default {
    data() {
        return {
            file: [],
            response: [],
            readyArr: [],
            working: false,
            isDataExistInDB: false
        }
    },
    mounted() {
        this.check()
    },
    watch: {
        file() {
            const promise = new Promise((resolve, reject) => {
                const reader = new FileReader();
                const vm = this;
                reader.onload = e => {
                    resolve((vm.fileinput = reader.result));
                };
                reader.readAsText(this.file);
            });
            promise.then(
                result => {
                    const lines = result.split('\n')
                    const header = lines[0].split(',')
                    const output = lines.slice(1).map(line => {
                        const fields = line.replace(/"/g, '').split(',')
                        const json = Object.fromEntries(header.map((h, i) => [this.cleanNamesColumns(h), fields[i]]));
                        json.reviewer = json.reviewer ?? '';
                        json.email = json.email ?? '';
                        json.review = json.review ?? '';
                        json.rating = json.rating ?? '';
                        json.employee = json.employee ?? '';
                        return json;
                    });
                    this.response = this.validColumn(output[0]);

                    if(this.response.length) {
                        this.readyArr = [];
                    }else {
                        this.readyArr = output;
                    }
                },
                error => {
                    this.readyArr = [];
                }
            );
        }
    },
    methods: {
        cleanNamesColumns(columns) {
            return columns.replace(/\s+/, '_').replace(/"/g, '').toLowerCase()
        },
        validColumn(fistRow) {
            let res = [];
            const importantFields = ['reviewer', 'email', 'review', 'rating', 'employee', 'employees_position', 'unique_employee_number', 'company', 'company_description'];
            let i = 0;
            for(const nameColumn in fistRow){
                let findField = '';
                importantFields.forEach((importantField) => {
                    if(importantField === nameColumn) {
                        findField = importantField;
                        return false;
                    }
                })
                if(findField === '') {
                    res.push({
                        id: i,
                        message: nameColumn + ' is the wrong field',
                        status: 'error'
                    });
                }
            }
            console.log()
            return res;
        },
        send() {
            this.working = true;

            axios.post('/distribution', {
                data: this.readyArr
            }, {
                'Content-Type': 'application/json'
            }).then((res) => {
                this.file = [];
                this.readyArr = [];
                this.working = false;

                this.response = res.data.status;
                this.check();
            }).catch((error) => {
                this.file = [];
                this.readyArr = [];
                this.working = false;
                let i = 1;
                Object.values(error.response.data.errors).forEach((messages) => {
                    messages.forEach(message => {
                        this.response.push({
                            id: i++,
                            message: message,
                            status: 'error'
                        })
                    })
                })
                this.check();
            })
        },
        clean() {
            this.working = true;

            axios.post('/testimonial/clean', {
                data: this.readyArr
            }, {
                'Content-Type': 'application/json'
            }).then((res) => {
                this.file = [];
                this.readyArr = [];
                this.working = false;
                this.response = res.data.status
                this.check();
            }).catch((res) => {
                this.file = [];
                this.readyArr = [];
                this.working = false;
                this.check();
            })
        },
        check() {
            this.working = true;
            axios.get('/testimonial/check',{
                'Content-Type': 'application/json'
            }).then((res) => {
                this.working = false;
                this.isDataExistInDB = res.data.status
            }).catch((res) => {
                this.working = false;
            })
        }
    }
}
</script>
<style scoped>

</style>
