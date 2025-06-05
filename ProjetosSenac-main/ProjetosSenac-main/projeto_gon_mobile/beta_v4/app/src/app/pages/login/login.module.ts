import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { LoginPageRoutingModule } from './login-routing.module';

import { LoginPage } from './login.page';
import { SolicitaSenhaComponent } from 'src/app/component/modals/solicita-senha/solicita-senha.component';
import { VerificaCodigoComponent } from 'src/app/component/modals/verifica-codigo/verifica-codigo.component';
import { RedefineSenhaComponent } from 'src/app/component/modals/redefine-senha/redefine-senha.component';

@NgModule({
  imports: [CommonModule, FormsModule, IonicModule, LoginPageRoutingModule],
  declarations: [LoginPage, SolicitaSenhaComponent,VerificaCodigoComponent,RedefineSenhaComponent],
})
export class LoginPageModule {}
