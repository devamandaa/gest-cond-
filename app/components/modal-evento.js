import Component from "@glimmer/component";
import {action} from "@ember/object";

export default class ModalEventoComponent extends Component{
    @action fechar () {
        if (this.args.onFechar) {
            this.args.onFechar();
        }
    }
}