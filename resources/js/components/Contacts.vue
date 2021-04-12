<template>
    <div class="contacts-form-container flex flex-col space-around">
        <div class="contacts-form-element">
            <label>Your Name: &nbsp;</label><span v-if="errors.name" class="error-span text-danger">{{errors.name[0]}}</span>
            <input v-bind:class="{ danger : errors.name }" v-model="name" type="text" name='name'>
        </div>
        <div class="contacts-form-element">
            <label>Your Email: &nbsp;</label><span v-if="errors.email" class="error-span text-danger">{{errors.email[0]}}</span>
            <input v-bind:class="{ danger : errors.email }" v-model="email" type="text" name="email">
        </div>
        <div class="contacts-form-element">
            <label>Question: &nbsp;</label><span v-if="errors.question" class="error-span text-danger">{{errors.question[0]}}</span>
            <textarea v-bind:class="{ danger : errors.question }" v-model="question" class="contacts-textarea" rows="5"></textarea>
        </div>
        <div @click="hideSuccess" class="relative flex centering contacts-success">
            <span class="success">
                Message sent
                <i class="fas fa-window-close"></i>
            </span>
        </div>
        <div class="contacts-form-element">
            <button @click="sendQuestion" class="btn contacts-btn">Submit</button>
        </div>
    </div>
</template>

<script>

export default {
    data: function() {
        return {
            name: '',
            email: '',
            question: '',
            result: '',
            errors: [],
            success: ''
        }
    },
    methods: {
        sendQuestion() {
            axios.post('/contacts', {
                name: this.name,
                email: this.email,
                question: this.question
            })
            .then(response => {
                if (response.status === 200) {
                    this.success = response.data.result;
                    this.name = '';
                    this.email = '';
                    this.question = '';
                    this.showSuccess();
                }
            })
            .catch(e => {
                if (e.response.status === 422) {
                    this.errors = e.response.data.errors;
                }
            })
        },
        showSuccess() {
            let successSpan = document.querySelector('.contacts-success');
            successSpan.classList.add('active-success');
        },
        hideSuccess() {
            let successSpan = document.querySelector('.contacts-success');
            successSpan.classList.toggle('active-success');
        }
    }
}
</script>
