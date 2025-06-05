import { Component, OnInit } from '@angular/core';
import { ModalController } from '@ionic/angular';

@Component({
  selector: 'app-redefine-senha',
  templateUrl: './redefine-senha.component.html',
  styleUrls: ['./redefine-senha.component.scss'],
})
export class RedefineSenhaComponent implements OnInit {
  
  constructor(private modalCtrl: ModalController) {}

  ngOnInit() {
    // Implementação específica da inicialização da página de login
  }

  cancel() {
    return this.modalCtrl.dismiss(null, 'cancel');
  }
}
