import { Component } from '@angular/core';
// import function to register Swiper custom elements
import { register } from 'swiper/element/bundle';
// register Swiper custom elements
register();

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage {

  items = [
    {
      id: 1,
      nomeBarbearia: 'Nome da Barbearia',
      nota: '4,7',
      km: '2,3 km'
    },
    {
      id: 2,
      nomeBarbearia: 'Nome da Barbearia',
      nota: '4,7',
      km: '2,3 km'
    },
    {
      id: 3,
      nomeBarbearia: 'Nome da Barbearia',
      nota: '4,7',
      km: '2,3 km'
    },
    {
      id: 4,
      nomeBarbearia: 'Nome da Barbearia',
      nota: '4,7',
      km: '2,3 km'
    },
    {
      id: 5,
      nomeBarbearia: 'Nome da Barbearia',
      nota: '4,7',
      km: '2,3 km'
    },
  ]


  tesouraPente: string = '../assets/img/tesoura-e-pente.png';
  // nomeBarbearia: string = 'Nome da Barberria';
  // nota: string = '4,7';
  // km: string = '2,3 km';
  constructor() {}
}
