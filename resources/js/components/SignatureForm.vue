<template>
    <div class="container">
        <div class="alert alert-success my-3" role="alert" v-if="saved">
            <strong>Success!</strong> Your signature has been saved successfully.
        </div>

        <div class="container" id="signature-form">
            <h2 class="text-center font-weight-bold my-4">Sign the Guestbook</h2>
            <form method="post" @submit.prevent="onSubmit">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="name">Name</label>
                    <div class="col-sm-10" :class="{ 'has-error': errors.name }">
                        <input id="name" v-model="signature.name" type="text" placeholder="Your name" class="form-control" aria-describedby="err1" required/>
                        <small v-if="errors.name" class="form-text text-danger" id="err1">{{ errors.name[0] }}</small>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="email">Your E-mail</label>
                    <div class="col-sm-10" :class="{ 'has-error': errors.email }">
                        <input id="email" v-model="signature.email" type="text" placeholder="Your email" class="form-control" aria-describedby="err2" required/>
                        <small v-if="errors.email" class="form-text text-danger" id="err2">{{ errors.email[0] }}</small>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="body">Your message</label>
                    <div class="col-sm-10" :class="{ 'has-error': errors.body }">
                        <textarea class="form-control" id="body" v-model="signature.body" placeholder="Enter your message here..." rows="5" aria-describedby="err3" required></textarea>
                        <small v-if="errors.body" class="form-text text-danger" id="err3">{{ errors.body[0] }}</small>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 text-right">
                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            errors: [],
            saved: false,
            signature: {
                name: null,
                email: null,
                body: null
            }
        };
    },

    methods: {
        onSubmit() {
            this.saved = false;

            axios
                .post("signatures", this.signature)
                .then(({ data }) => this.setSuccessMessage(data))
                .catch(({ response }) => this.setErrors(response));
        },

        setErrors(response) {
            this.errors = response.data.errors;
        },

        setSuccessMessage() {
            this.reset();
            this.saved = true;
        },

        reset() {
            this.errors = [];
            this.signature = { name: null, email: null, body: null };
        }
    }
};
</script>
