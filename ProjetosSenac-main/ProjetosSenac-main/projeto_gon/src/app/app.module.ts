import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { NbThemeModule, NbLayoutModule, NbSidebarModule, NbIconModule, NbSelectModule, NbActionsModule, NbUserModule, NbContextMenuModule, NbMenuModule, NbToastrModule, NbDialogModule, NbToggleModule, NbListModule} from '@nebular/theme';
import { NbEvaIconsModule } from '@nebular/eva-icons';

import { ApiService } from './services/ApiService';

import { HeaderComponent } from './views/components/header/header.component';
import { SidebarComponent } from './views/components/sidebar/sidebar.component';
import { FooterComponent } from './views/components/footer/footer.component';

import { PagesModule } from './views/pages/pages.module';

import { FormsModule } from '@angular/forms';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { ModalModule } from './views/modal/modal.module';



@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    SidebarComponent,
    FooterComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    FormsModule,
    NbThemeModule.forRoot({ name: 'default' }),
    NbLayoutModule,
    NbEvaIconsModule,
    NbIconModule,
    NbSelectModule,
    NbActionsModule,
    NbUserModule,
    NbContextMenuModule,
    NbMenuModule.forRoot(),
    NbSidebarModule.forRoot(),
    NbToastrModule.forRoot(),
    NbDialogModule.forRoot({ context: String }),
    HttpClientModule,
    PagesModule,
    ModalModule,
    NbToggleModule,
  ],
  providers: [
    ApiService,
    HttpClient,
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
