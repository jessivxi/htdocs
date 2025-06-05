import { NbMenuItem } from '@nebular/theme';

export const MENU_ITEMS: NbMenuItem[] = [
  {
    title: 'Página Inicial',
    icon: 'home-outline',
    link: '/',
    home: true,
  },
  {
    title: 'Agenda',
    icon: 'calendar-outline',
    link: '/pages/agendas',
  },
  {
    title: 'Dados Clientes',
    icon: 'edit-2-outline',
    link: '/pages/clientes',
  },
  {
    title: 'Colaboradores',
    icon: 'people-outline',
    link: '/pages/colaboradores',
  },
  {
    title: 'Serviços',
    icon: 'shopping-bag-outline',
    link: '/pages/servicos',
  },
  {
    title: 'Locais de Atividade',
    icon: 'pin-outline',
    link: '/pages/locais',
  },
  {
    title: 'Financeiro',
    icon: 'inbox-outline',
    link: '/pages/financeiro',
  },
  {
    title: 'Configurações',
    icon: 'settings-2-outline',
    link: '/pages/configuracoes',
  },
];
