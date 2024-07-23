//
//  FeatureCards.swift
//  lpz
//
//  Created by Jose Antonio Lopez Lopez on 10/7/23.
//

import SwiftUI

struct FeatureCards: View {
    var landmark: Landmark
    
    var body: some View {
        landmark.featureImage?
            .resizable()
            .aspectRatio(3/2, contentMode: .fit)
            .overlay {
                TextOverlay(landmark: landmark)
            }
    }
}

struct TextOverlay: View {
    var landmark: Landmark
    
    var gradient: LinearGradient {
        .linearGradient(
            Gradient(
                colors: [.black.opacity(0.6), .black.opacity(0)]
            ),
            startPoint: .bottom,
            endPoint: .center
        )
    }
    
    var body: some View {
        ZStack(alignment: .bottomLeading) {
            gradient
            VStack(alignment: .leading) {
                Text(landmark.name)
                    .font(.title)
                    .bold()
                Text(landmark.park)
            }
            .padding()
        }
        .foregroundColor(.white)
    }
}

struct FeatureCards_Previews: PreviewProvider {
    static var previews: some View {
        FeatureCards(landmark: ModelData().features[0])
    }
}
