import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { HomeComponent } from './views/pages/home/home.component';
import { ClientesComponent } from './views/pages/clientes/clientes.component';
import { ColaboreadoresComponent } from './views/pages/colaboreadores/colaboreadores.component';
import { LocaisComponent } from './views/pages/locais/locais.component';
import { ServicosComponent } from './views/pages/servicos/servicos.component';
import { AgendasComponent } from './views/pages/agendas/agendas.component';
import { FinanceiroComponent } from './views/pages/financeiro/financeiro.component';
import { ConfiguracoesComponent } from './views/pages/configuracoes/configuracoes.component';
import { ModalRlColabServFormComponent } from './views/modal/modal-rl-colab-serv-form/modal-rl-colab-serv-form.component';

const routes: Routes = [
  {
    path: '',
    title: 'Gon |',
    component: HomeComponent,
  },
  {
    path: 'pages',
    title: 'Gon | ',
    children: [
      {
        path: 'agendas',
        title: 'Gon | Agenda',
        component: AgendasComponent,
      },
      {
        path: 'clientes',
        title: 'Gon | Clientes',
        component: ClientesComponent,
      },
      {
        path: 'colaboradores',
        title: 'Gon | colaboradores',
        component: ColaboreadoresComponent,
      },
      {
        path: 'servicos',
        title: 'Gon | Serviços',
        component: ServicosComponent,
      },
      {
        path: 'locais',
        title: 'Gon | Locais Atividades',
        component: LocaisComponent,
      },
      {
        path: 'financeiro',
        title: 'Gon | Financeiro',
        component: FinanceiroComponent,
      },
      {
        path: 'configuracoes',
        title: 'Gon | Configurações',
        component: ConfiguracoesComponent,
      },
    ],
  },
  {
    path: '**',
    component: HomeComponent,
  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
})
export class AppRoutingModule {}
