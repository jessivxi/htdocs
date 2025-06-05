import { Component, OnInit } from '@angular/core';
import { ModalController } from '@ionic/angular';
import { VerificaCodigoComponent } from '../verifica-codigo/verifica-codigo.component';

@Component({
  selector: 'app-solicita-senha',
  templateUrl: './solicita-senha.component.html',
  styleUrls: ['./solicita-senha.component.scss'],
})
export class SolicitaSenhaComponent {
  constructor(private modalCtrl: ModalController) {}

  ngOnInit() {
    // Implementação específica da inicialização da página de login
  }

  cancel() {
    return this.modalCtrl.dismiss(null, 'cancel');
  }

  async openModal() {
    const modal = await this.modalCtrl.create({
      component: VerificaCodigoComponent,
    });
    modal.present();
  }
}
