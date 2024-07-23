//
//  LandmarkList.swift
//  lpz
//
//  Created by Jose Antonio Lopez Lopez on 26/6/23.
//

import SwiftUI

struct LandmarkList: View {
    @State private var showFavoriteOnly: Bool = false
    @EnvironmentObject var modelData: ModelData
    
    var filteredLandmarks: [Landmark] {
        modelData.landmarks.filter { landmark in
            (!showFavoriteOnly || landmark.isFavorite)
        }
    }
    
    var body: some View {
        //List(landmarks, id: \.id){ landmark in
        NavigationView {
            List{
                Toggle(isOn: $showFavoriteOnly){
                    Text("Favorites only")
                        .bold()
                }
                ForEach(filteredLandmarks) { landmark in
                    NavigationLink{
                        LandmarkDetail(landmark: landmark)
                    } label: {
                        LandmarkRow(landmark: landmark)
                    }
                }
            }.navigationTitle("Landmarks")
        }
    }
}

struct LandmarkList_Previews: PreviewProvider {
    static var previews: some View {
        LandmarkList().environmentObject(ModelData())
    }
}
