<template>
    <div class='home'>
        <div class="container-lg">
            <div class="row justify-content-center text-center">
                <div class='nav'>
                    <img alt='laravellama-logo' src="/imgs/laravellama-logo-text.png" style="cursor: pointer"
                         @click="welcome = true"/>
                    <!--                    <p style="cursor: pointer" @click="this.welcome = true">LaraveLLama</p>-->
                    <a href="https://github.com/xndrgit/xndr-laravellama">
                        <img alt='laravellama-logo' src="/imgs/laravellama-logo.jpg"/>
                    </a>
                </div>
                <div v-if="welcome" class='main-container col-10'>
                    <div class='greet'>
                        <p><span>Ehy! This is LaraveLLama.</span></p>
                        <p>How can I help you today?</p>
                    </div>
                </div>
                <div v-else class="result text-start col-10">
                    <!--                    <div class="result-title">-->
                    <!--                        <a href="https://github.com/xndrgit/xndr-laravellama">-->
                    <!--                            <img alt="user-icon" src="/imgs/user-icon.jpg"/>-->
                    <!--                        </a>-->
                    <!--                        <p v-if="!promptCopy">Developed by XndrDEV</p>-->
                    <!--                        <p>{{ promptCopy }}</p>-->
                    <!--                    </div>-->
                    <div class="result-data">
                        <a href="https://github.com/xndrgit/xndr-laravellama">
                            <img alt='laravellama-logo' src="/imgs/laravellama-logo.jpg"/>
                        </a>
                        <p v-if="!loading">{{ response }}</p>
                        <div v-if="loading" class="loader">
                            <hr/>
                            <hr/>
                            <hr/>
                        </div>
                    </div>

                </div>


                <div class='main-bottom'>
                    <div v-if="!loading" class='search-box col-12 col-sm-6'>
                        <form @submit.prevent="send">
                            <input v-model="prompt" placeholder='Enter a prompt here' type='text'/>
                            <img v-if="prompt" alt='send-icon-laravellama' src="/imgs/send_icon.png" @click="send"/>
                        </form>
                    </div>
                    <p class='bottom-info'>
                        LaraveLLama use a Local LLM into Your Laravel Projects with Ollama AI.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
            welcome: true,
            prompt: '',
            promptCopy: '',
            response: null,
        };
    },
    methods: {
        send() {
            this.promptCopy = this.prompt;
            this.prompt = '';
            if (this.welcome) {
                this.welcome = false;
            }
            this.loading = true;

            this.$nextTick(() => {
                this.getResponse();
            });
        },
        async getResponse() {
            try {
                console.log('Sending request with prompt:', this.promptCopy); // Debugging log
                const res = await fetch('/api/ollama-response', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ prompt: this.promptCopy }),
                });

                if (!res.ok) {
                    throw new Error(`HTTP error! status: ${res.status}`);
                }

                const data = await res.json();
                console.log('Received response:', data); // Debugging log

                this.response = data.response;
            } catch (error) {
                console.error('Error fetching response:', error);
                console.log(error.message);
                this.response = `Error fetching response: ${error.message}`;
            } finally {
                this.loading = false;
            }
        },
    },
};
</script>

<style scoped>
.home {
    flex: 1;
    min-height: 100vh;
    padding-bottom: 15vh;
    position: relative;
    background-color: #121212;
    color: #ffffff;
}

.nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 22px;
    padding: 20px;
    color: #cccccc;

    img {
        width: 150px;
        border-radius: 50%;
    }
}

.main-container {
    margin: auto;
    height: calc(100vh - 300px);
    display: flex;
    align-items: center;
    justify-content: center;

    .greet {
        margin: 50px 0;
        font-size: 56px;
        color: #c4c7c5;
        font-weight: 500;
        padding: 20px;

        span {
            background: -webkit-linear-gradient(16deg, #4b90ff, #ff5546);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    }
}

.result::-webkit-scrollbar {
    display: none;
}

.result {
    padding: 0 5%;
    overflow-y: scroll;
    height: calc(100vh - 300px);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #dddddd;

    p {
        width: 100%;
        font-size: 17px;
        font-weight: 300;
        line-height: 1.8;
    }

    img {
        min-width: 40px;
        width: 40px;
        border-radius: 50%;
        cursor: pointer;
    }

    .result-title {
        width: 100%;
        margin: 40px 0;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .result-data {
        width: 100%;
        display: flex;
        align-items: start;
        gap: 20px;
    }

    .loader {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 10px;

        hr {
            border-radius: 4px;
            border: none;
            background: #333; /* Darker background for dark theme */
            background: linear-gradient(to right, #444, #777, #444); /* Dark gradient */
            background-size: 800px 50px;
            height: 20px;

            animation: loader 3s infinite linear;
        }

    }
}

.main-bottom {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 100%;
    position: absolute;
    bottom: 0;
    padding: 0 20px;
    margin: auto;

    .search-box {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        background: #333333;
        padding: 10px 20px;
        border-radius: 50px;
        color: #ffffff;

        img {
            width: 24px;
            cursor: pointer;
        }

        input {
            flex: 1;
            background: transparent;
            border: none;
            outline: none;
            padding: 8px;
            font-size: 18px;
            color: #ffffff;
        }

        form {
            display: contents;
            width: 100%;
        }
    }

    .bottom-info {
        font-size: 13px;
        margin: 15px auto;
        text-align: center;
        font-weight: 300;
        color: #bbbbbb;
    }
}


@keyframes loader {
    0% {
        background-position: -800px 0;
    }
    100% {
        background-position: 800px 0;
    }
}
</style>
