<template>
    <div>
        <h1>Ollama Response</h1>
        <form @submit.prevent="getResponse">
            <div>
                <label for="prompt">Enter your prompt:</label>
                <input id="prompt" v-model="prompt" type="text"/>
            </div>
            <button type="submit">Submit</button>
        </form>
        <div v-if="response">
            <h2>Response:</h2>
            <p>{{ response }}</p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            prompt: '',
            response: null,
        };
    },
    methods: {
        async getResponse() {
            try {
                console.log('Sending request with prompt:', this.prompt); // Debugging log
                const res = await fetch('/api/ollama-response', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ prompt: this.prompt }),
                });

                if (!res.ok) {
                    throw new Error(`HTTP error! status: ${res.status}`);
                }

                const data = await res.json();
                console.log('Received response:', data); // Debugging log

                this.response = data.response;
            } catch (error) {
                console.error('Error fetching response:', error);
                this.response = `Error fetching response: ${error.message}`;
            }
        },
    },
};
</script>

<style scoped>
form {
    margin-bottom: 20px;
}
</style>
