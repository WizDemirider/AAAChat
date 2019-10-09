<template>
    <div class="chat-app">
        <Conversation :contact="selectedContact" :messages="messages"/>
        <ContactsList :contacts="contacts" />
    </div>
</template>

<script>
    import Conversation from './Conversation';
    import ContactsList from './ContactsList';
    export default {
        data() {
            return {
                selectedContact: null,
                messages: [],
                contacts: []
            }
        },
        mounted() {
            axios.get('/contacts').then((response) => {
                console.log(response.data);
                this.contacts = response.data;
            })
            console.log('Component mounted.');
        },
        components: {Conversation,ContactsList}
    }
</script>
