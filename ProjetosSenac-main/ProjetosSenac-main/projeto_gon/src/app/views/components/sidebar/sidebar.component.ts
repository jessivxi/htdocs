import { Component, OnInit } from '@angular/core';
import { MENU_ITEMS } from './sidebar.menu';

@Component({
  selector: 'app-sidebar',
  templateUrl: './sidebar.component.html',
  styleUrls: ['./sidebar.component.scss']
})
export class SidebarComponent implements OnInit {

  menu = MENU_ITEMS;
  constructor(
    
  ) { }

  ngOnInit(): void {
  }

}
