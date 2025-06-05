import { Component, OnInit } from '@angular/core';
import { ModalController } from '@ionic/angular';
import { RedefineSenhaComponent } from '../redefine-senha/redefine-senha.component';

@Component({
  selector: 'app-verifica-codigo',
  templateUrl: './verifica-codigo.component.html',
  styleUrls: ['./verifica-codigo.component.scss'],
})
export class VerificaCodigoComponent implements OnInit {
  constructor(private modalCtrl: ModalController) {}

  ngOnInit() {
    // Implementação específica da inicialização da página de login
  }

  cancel() {
    return this.modalCtrl.dismiss(null, 'cancel');
  }

  async openModal() {
    const modal = await this.modalCtrl.create({
      component: RedefineSenhaComponent,
    });
    modal.present();
  }
}
