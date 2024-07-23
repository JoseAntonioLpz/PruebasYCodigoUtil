//
//  lpzApp.swift
//  lpz
//
//  Created by Jose Antonio Lopez Lopez on 22/6/23.
//

import SwiftUI

@main
struct lpzApp: App {
    @StateObject private var modelData = ModelData();
    
    var body: some Scene {
        WindowGroup {
            ContentView()
                .environmentObject(modelData)
        }
    }
}
