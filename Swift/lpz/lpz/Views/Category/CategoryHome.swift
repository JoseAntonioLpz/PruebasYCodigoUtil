//
//  CategoryHome.swift
//  lpz
//
//  Created by Jose Antonio Lopez Lopez on 4/7/23.
//

import SwiftUI

struct CategoryHome: View {
    @EnvironmentObject var modelData: ModelData
    @State private var showingProfile: Bool = false
    
    var body: some View {
        NavigationView {
            List {
                PageView(pages: modelData.features.map{FeatureCards(landmark: $0)})
                    .aspectRatio(3/2, contentMode: .fit)
                    .listRowInsets(EdgeInsets())

                ForEach(
                    modelData.categories.keys.sorted(), id: \.self
                ) { key in
                    CategoryRow(
                        name: key,
                        items: modelData.categories[key]!
                    )
                }
                .listRowInsets(EdgeInsets())
            }
            .listStyle(.inset)
                .navigationTitle("Featured")
                .toolbar {
                    Button{
                        showingProfile.toggle()
                    } label: {
                        Label("User Profile", systemImage: "person.crop.circle")
                    }
                }
                .sheet(isPresented: $showingProfile) {
                    ProfileHost()
                        .environmentObject(modelData)
                }
        }
    }
}

struct CategoryHome_Previews: PreviewProvider {
    static var previews: some View {
        CategoryHome()
            .environmentObject(ModelData())
    }
}
