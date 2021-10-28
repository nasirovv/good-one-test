import {createApp} from "vue";
import axios from "axios";
import VueAxios from "vue-axios";
import App from './Components/App'

createApp(App).use(VueAxios, axios).mount("#app")
