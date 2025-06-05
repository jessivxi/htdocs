import { CKEditorModule } from '@ckeditor/ckeditor5-angular';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { NbButtonGroupModule, NbButtonModule, NbCardModule, NbIconModule, NbPopoverModule, NbSpinnerModule, NbToggleModule } from '@nebular/theme';

import { Angular2SmartTableModule } from 'angular2-smart-table';

import { HomeComponent } from './home/home.component';
import { ReactiveFormsModule } from '@angular/forms';
import { ClientesComponent } from './clientes/clientes.component';
import { ColaboreadoresComponent } from './colaboreadores/colaboreadores.component';
import { LocaisComponent } from './locais/locais.component';
import { ServicosComponent } from './servicos/servicos.component';
import { AgendasComponent } from './agendas/agendas.component';
import { FinanceiroComponent } from './financeiro/financeiro.component';
import { ConfiguracoesComponent } from './configuracoes/configuracoes.component';

@NgModule({
  declarations: [
    HomeComponent,
    ClientesComponent,
    ColaboreadoresComponent,
    LocaisComponent,
    ServicosComponent,
    AgendasComponent,
    FinanceiroComponent,
    ConfiguracoesComponent,
  ],
  imports: [
    CKEditorModule,
    CommonModule,
    NbIconModule,
    NbCardModule,
    NbButtonModule,
    NbButtonGroupModule,
    Angular2SmartTableModule,
    NbPopoverModule,
    NbSpinnerModule,
    NbToggleModule,
    ReactiveFormsModule
  ]
})
export class PagesModule { }
