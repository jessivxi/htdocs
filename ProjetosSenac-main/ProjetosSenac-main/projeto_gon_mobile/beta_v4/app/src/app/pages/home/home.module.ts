import { NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { CommonModule } from '@angular/common';
import { IonicModule } from '@ionic/angular';
import { FormsModule } from '@angular/forms';
import { HomePage } from './home.page';

import { HomePageRoutingModule } from './home-routing.module';
import { HeaderLocalNotifComponent } from '../../component/header/local-notif/header-local-notif.component';
import { TabsComponent } from 'src/app/component/tabs/tabs.component';
import { RouterModule } from '@angular/router';

@NgModule({
  imports: [CommonModule, FormsModule, IonicModule, HomePageRoutingModule, RouterModule.forChild([{ path: '', component: HomePageModule }])],
  declarations: [HomePage, HeaderLocalNotifComponent, TabsComponent],
  schemas: [CUSTOM_ELEMENTS_SCHEMA],
})
export class HomePageModule {}
