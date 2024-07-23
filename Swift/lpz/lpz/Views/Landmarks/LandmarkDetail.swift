//
//  ContentView.swift
//  lpz
//
//  Created by Jose Antonio Lopez Lopez on 22/6/23.
//

import SwiftUI

struct LandmarkDetail: View {
    @EnvironmentObject var modelData: ModelData
    
    var landmark: Landmark
    
    var landmarkIndex: Int {
        modelData.landmarks.firstIndex(where: {
            $0.id == landmark.id
        })!
    }
    
    var body: some View {
        ScrollView {
            MapView(coordinates: landmark.locationCoordinates)
                .ignoresSafeArea(edges: .top)
                .frame(height: 300)
            ImageView(image: landmark.image)
                .offset(y: -110)
                .padding(.bottom, -110)
            VStack(alignment: .leading) {
                HStack {
                    Text(landmark.name)
                        .font(.title)
                    .fontWeight(.light)
                    
                    FavoriteButton(isSet: $modelData.landmarks[landmarkIndex].isFavorite)
                }
                HStack {
                    Text(landmark.park)
                    Spacer()
                    Text(landmark.park)
                }
                .font(.subheadline)
                .foregroundColor(.secondary)
                Divider()
                Text("About \(landmark.name)")
                    .font(.title2)
                Text(landmark.description)
            }
            .padding()
        }
        .navigationTitle(landmark.name)
    }
}


struct LandmarkDetail_Previews: PreviewProvider {
    static var previews: some View {
        LandmarkDetail(landmark: ModelData().landmarks[0])
            .environmentObject(ModelData())
    }
}
