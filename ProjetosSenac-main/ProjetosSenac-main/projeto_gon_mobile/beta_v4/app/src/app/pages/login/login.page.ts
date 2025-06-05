import { Component, OnInit } from '@angular/core';
import { ModalController } from '@ionic/angular';
import { SolicitaSenhaComponent } from 'src/app/component/modals/solicita-senha/solicita-senha.component';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage {
  constructor(private modalCtrl: ModalController) {}

  ngOnInit() {}

  async openModal() {
    const modal = await this.modalCtrl.create({
      component: SolicitaSenhaComponent,
    });
    modal.present();
  }
}
